<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegionRequest;
use App\Models\Region;
use App\Support\Locales;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $regions = Region::withCount('secretaries')->orderBy('sort_order')->paginate(20);

        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create', ['region' => new Region]);
    }

    public function store(RegionRequest $request)
    {
        $region = DB::transaction(function () use ($request) {
            $region = Region::create($this->payload($request));
            $this->syncSecretaries($request, $region);

            return $region;
        });

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$this->label($region)}' created.");
    }

    public function edit(Region $region)
    {
        $region->load('secretaries');

        return view('admin.regions.edit', compact('region'));
    }

    public function update(RegionRequest $request, Region $region)
    {
        DB::transaction(function () use ($request, $region) {
            $region->update($this->payload($request, $region));
            $this->syncSecretaries($request, $region);
        });

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$this->label($region)}' updated.");
    }

    public function destroy(Region $region)
    {
        $label = $this->label($region);
        $this->deleteUploadedImage($region->image);
        $this->deleteUploadedImage($region->hero_image);
        $region->delete();

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$label}' deleted.");
    }

    /**
     * How to name a region in a message. Records written while English was the
     * authored language have no Uzbek value, so fall back rather than print
     * an empty string.
     */
    private function label(Region $region): string
    {
        return $region->authored('name') ?: $region->slug;
    }

    private function payload(RegionRequest $request, ?Region $region = null): array
    {
        $data = collect($request->validated())
            ->only((new Region)->getFillable())
            ->all();

        $data['sort_order'] = $data['sort_order'] ?? ($region?->sort_order ?? Region::max('sort_order') + 1);
        $data['image'] = $this->storeImage($request, 'image_file', 'regions', $region?->image);
        $data['hero_image'] = $this->storeImage($request, 'hero_image_file', 'regions', $region?->hero_image);

        foreach (RegionRequest::LINE_LISTS as $field) {
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
     * Turn the per-language textareas into [{uz, en, ja}, ...], pairing by line
     * number. The authored language is the spine: it decides how many items
     * there are and which rows survive. It used to be English, which silently
     * dropped every row an admin had only written in Uzbek.
     */
    private function zipLines(RegionRequest $request, string $field): array
    {
        $lines = collect(Locales::ORDER)->mapWithKeys(fn (string $locale) => [
            $locale => preg_split('/\R/', trim((string) $request->input("{$field}_{$locale}"))),
        ]);

        return collect($lines[Locales::SOURCE])
            ->map(fn (string $source, int $i) => [
                'uz' => trim($source),
                'en' => trim($lines['en'][$i] ?? '') ?: trim($source),
                'ja' => trim($lines['ja'][$i] ?? '') ?: trim($source),
            ])
            ->filter(fn (array $item) => $item[Locales::SOURCE] !== '')
            ->values()
            ->all();
    }

    private function syncSecretaries(RegionRequest $request, Region $region): void
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
