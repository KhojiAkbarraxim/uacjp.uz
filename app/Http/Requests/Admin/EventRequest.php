<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\HasLocaleRules;
use App\Models\Event;
use App\Support\Images;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    use HasLocaleRules;

    /** The admin routes are already behind EnsureAdminAuthenticated. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'thumbnail_file' => Images::rules(),
            'gallery_images' => ['nullable', 'array', $this->galleryCountRule()],
            'gallery_images.*' => Images::rules(),
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer', Rule::exists('event_images', 'id')->where('event_id', $this->event()?->id)],
            ...$this->localeRules(['title', 'location', 'type'], required: true),
        ];
    }

    private function event(): ?Event
    {
        $event = $this->route('event');

        return $event instanceof Event ? $event : null;
    }

    /** At most 7 gallery images total, counting what stays after deletions plus what's uploaded now. */
    private function galleryCountRule(): \Closure
    {
        return function (string $attribute, array $value, \Closure $fail) {
            $existing = $this->event()?->images()->count() ?? 0;
            $deleting = count(array_filter((array) $this->input('delete_images', [])));

            if ($existing - $deleting + count($value) > 7) {
                $fail('An event can have at most 7 gallery images in total.');
            }
        };
    }
}
