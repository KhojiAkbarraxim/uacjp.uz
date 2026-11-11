<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\HasLocaleRules;
use App\Models\News;
use App\Support\Images;
use App\Support\Slug;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    use HasLocaleRules;

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
            'slug' => ['required', 'string', 'max:255', Rule::unique('news', 'slug')->ignore($this->article())],
            'date' => ['required', 'date'],
            'image_file' => Images::rules(),
            ...$this->localeRules(['title'], required: true),
            ...$this->localeRules(['type']),
            ...$this->localeRules(['summary', 'body'], ['nullable', 'string']),
        ];
    }

    /**
     * A slug the admin typed is kept as it is, so a clash surfaces as a
     * validation error instead of silently becoming a different address.
     * A generated one is numbered until free, because Uzbek titles collapse
     * onto the same ASCII slug far more often than English ones did.
     */
    private function resolvedSlug(): string
    {
        $typed = $this->input('slug');

        return filled($typed)
            ? Str::slug($typed)
            : Slug::unique('news', $this->sourceInput('title'), $this->article()?->id);
    }

    private function article(): ?News
    {
        $news = $this->route('news');

        return $news instanceof News ? $news : null;
    }
}
