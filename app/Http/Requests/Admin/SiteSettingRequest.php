<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\HasLocaleRules;
use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    use HasLocaleRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // These three are plain values, not translations. They live in the
            // value_en column only because the settings table needs a slot.
            'contact_email' => ['required', 'email', 'max:255'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_telegram' => ['nullable', 'url', 'max:255'],
            ...$this->localeRules(['hero_caption'], ['nullable', 'string', 'max:500']),
        ];
    }
}
