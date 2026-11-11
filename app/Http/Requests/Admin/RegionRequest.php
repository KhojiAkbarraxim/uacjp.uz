<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\HasLocaleRules;
use App\Models\Region;
use App\Support\Images;
use App\Support\Slug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegionRequest extends FormRequest
{
    use HasLocaleRules;

    /** Lists of localized strings, edited as one item per line per language. */
    public const LINE_LISTS = ['universities', 'plans'];

    /** Nested structures, edited as raw JSON. */
    public const JSON_FIELDS = ['activities', 'gallery'];

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['slug' => $this->resolvedSlug()]);
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', Rule::unique('regions', 'slug')->ignore($this->region())],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_file' => Images::rules(),
            'hero_image_file' => Images::rules(),

            'secretaries' => ['nullable', 'array'],
            'secretaries.*.name' => ['nullable', 'string', 'max:255'],
            'secretaries.*.email' => ['nullable', 'email', 'max:255'],
            'secretaries.*.phone' => ['nullable', 'string', 'max:255'],
            'secretaries.*.telegram' => ['nullable', 'string', 'max:255'],

            ...$this->localeRules(['name', 'short_name'], required: true),
            ...$this->localeRules(['status', 'members_count', 'city', 'locations']),
            ...$this->localeRules(['summary', 'excerpt', 'about'], ['nullable', 'string']),
            ...$this->localeRules(self::LINE_LISTS, ['nullable', 'string']),
            ...$this->localeRules(['secretaries.*.role', 'secretaries.*.affiliation']),

            ...array_fill_keys(self::JSON_FIELDS, ['nullable', 'json']),
        ];
    }

    /** See NewsRequest::resolvedSlug - same rule, same reason. */
    private function resolvedSlug(): string
    {
        $typed = $this->input('slug');

        return filled($typed)
            ? Str::slug($typed)
            : Slug::unique('regions', $this->sourceInput('name'), $this->region()?->id);
    }

    private function region(): ?Region
    {
        $region = $this->route('region');

        return $region instanceof Region ? $region : null;
    }
}
