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
            'thumbnail_file' => Images::rules(),
            'gallery_images' => ['nullable', 'array', $this->galleryCountRule()],
            'gallery_images.*' => Images::rules(),
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer', Rule::exists('news_images', 'id')->where('news_id', $this->article()?->id)],
            ...$this->localeRules(['title'], required: true),
            ...$this->localeRules(['type']),
            ...$this->localeRules(['summary', 'body'], ['nullable', 'string']),
        ];
    }

    /** At most 7 gallery images total, counting what stays after deletions plus what's uploaded now. */
    private function galleryCountRule(): \Closure
    {
        return function (string $attribute, array $value, \Closure $fail) {
            $existing = $this->article()?->images()->count() ?? 0;
            $deleting = count(array_filter((array) $this->input('delete_images', [])));

            if ($existing - $deleting + count($value) > 7) {
                $fail('A news article can have at most 7 gallery images in total.');
            }
        };
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
