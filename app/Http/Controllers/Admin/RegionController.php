<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    use HandlesImageUploads;

    /** Lists of {en, uz, ja} strings, edited as one item per line per language. */
    private const LINE_LISTS = ['universities', 'plans'];

    /** Nested structures, edited as raw JSON. */
    private const JSON_FIELDS = ['activities', 'gallery'];

    public function index()
    {
        $regions = Region::withCount('secretaries')->orderBy('sort_order')->paginate(20);

        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create', ['region' => new Region]);
    }

    public function store(Request $request)
    {
        $region = DB::transaction(function () use ($request) {
            $region = Region::create($this->validated($request));
            $this->syncSecretaries($request, $region);

            return $region;
        });

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$region->name_en}' created.");
    }

    public function edit(Region $region)
    {
        $region->load('secretaries');

        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        DB::transaction(function () use ($request, $region) {
            $region->update($this->validated($request, $region));
            $this->syncSecretaries($request, $region);
        });

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$region->name_en}' updated.");
    }

    public function destroy(Region $region)
    {
        $name = $region->name_en;
        $this->deleteUploadedImage($region->image);
        $this->deleteUploadedImage($region->hero_image);
        $region->delete();

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$name}' deleted.");
    }

    private function validated(Request $request, ?Region $region = null): array
    {
        $request->merge(['slug' => Str::slug($request->input('slug') ?: $request->input('name_en', ''))]);

        $rules = [
            'slug' => ['required', 'string', 'max:255', Rule::unique('regions', 'slug')->ignore($region)],
            'name_en' => ['required', 'string', 'max:255'],
            'short_name_en' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_file' => $this->imageRules(),
            'hero_image_file' => $this->imageRules(),
            'secretaries' => ['nullable', 'array'],
            'secretaries.*.name' => ['nullable', 'string', 'max:255'],
            'secretaries.*.email' => ['nullable', 'email', 'max:255'],
            'secretaries.*.phone' => ['nullable', 'string', 'max:255'],
            'secretaries.*.telegram' => ['nullable', 'string', 'max:255'],
        ];

        foreach (['name_uz', 'name_ja', 'short_name_uz', 'short_name_ja'] as $field) {
            $rules[$field] = ['nullable', 'string', 'max:255'];
        }

        foreach (['status', 'members_count', 'city', 'locations'] as $base) {
            foreach (['en', 'uz', 'ja'] as $locale) {
                $rules["{$base}_{$locale}"] = ['nullable', 'string', 'max:255'];
                $rules["secretaries.*.role_{$locale}"] = ['nullable', 'string', 'max:255'];
                $rules["secretaries.*.affiliation_{$locale}"] = ['nullable', 'string', 'max:255'];
            }
        }

        foreach (['summary', 'excerpt', 'about'] as $base) {
            foreach (['en', 'uz', 'ja'] as $locale) {
                $rules["{$base}_{$locale}"] = ['nullable', 'string'];
            }
        }

        foreach (self::LINE_LISTS as $field) {
            foreach (['en', 'uz', 'ja'] as $locale) {
                $rules["{$field}_{$locale}"] = ['nullable', 'string'];
            }
        }

        foreach (self::JSON_FIELDS as $field) {
            $rules[$field] = ['nullable', 'json'];
        }

        $data = collect($request->validate($rules))
            ->only((new Region)->getFillable())
            ->all();

        $data['sort_order'] = $data['sort_order'] ?? ($region?->sort_order ?? Region::max('sort_order') + 1);
        $data['image'] = $this->storeImage($request, 'image_file', 'regions', $region?->image);
        $data['hero_image'] = $this->storeImage($request, 'hero_image_file', 'regions', $region?->hero_image);

        foreach (self::LINE_LISTS as $field) {
            $data[$field] = $this->zipLines($request, $field);
        }

        $data['activities'] = $this->jsonItems($request->input('activities'), fn (array $item) => [
            'title' => i18n_dict($item['title'] ?? ''),
            'date' => i18n_dict($item['date'] ?? ''),
            'description' => i18n_dict($item['description'] ?? ''),
        ]);
        $data['gallery'] = $this->jsonItems($request->input('gallery'), fn (array $item) => [
            'title' => i18n_dict($item['title'] ?? ''),
            'tone' => $item['tone'] ?? 'from-primary/90 to-primary/35',
        ]);

        return $data;
    }

    /**
     * Decode a JSON list and give every item the keys the public views expect,
     * so a hand-edited entry with a missing key can't break the region page.
     */
    private function jsonItems(?string $json, callable $normalize): array
    {
        return collect(json_decode($json ?: '[]', true) ?: [])
            ->filter(fn ($item) => is_array($item))
            ->map($normalize)
            ->values()
            ->all();
    }

    /**
     * Turn three per-language textareas into [{en, uz, ja}, ...], pairing by line number.
     */
    private function zipLines(Request $request, string $field): array
    {
        $lines = collect(['en', 'uz', 'ja'])->mapWithKeys(fn (string $locale) => [
            $locale => preg_split('/\R/', trim((string) $request->input("{$field}_{$locale}"))),
        ]);

        return collect($lines['en'])
            ->map(fn (string $en, int $i) => [
                'en' => trim($en),
                'uz' => trim($lines['uz'][$i] ?? '') ?: trim($en),
                'ja' => trim($lines['ja'][$i] ?? '') ?: trim($en),
            ])
            ->filter(fn (array $item) => $item['en'] !== '')
            ->values()
            ->all();
    }

    private function syncSecretaries(Request $request, Region $region): void
    {
        $region->secretaries()->delete();

        foreach ($request->input('secretaries', []) as $secretary) {
            if (blank($secretary['name'] ?? null)) {
                continue;
            }

            $region->secretaries()->create(collect($secretary)->only([
                'name', 'role_en', 'role_uz', 'role_ja',
                'affiliation_en', 'affiliation_uz', 'affiliation_ja',
                'email', 'phone', 'telegram',
            ])->all());
        }
    }
}
