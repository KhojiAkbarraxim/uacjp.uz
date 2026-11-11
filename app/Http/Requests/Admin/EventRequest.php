<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\HasLocaleRules;
use App\Support\Images;
use Illuminate\Foundation\Http\FormRequest;

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
            'image_file' => Images::rules(),
            ...$this->localeRules(['title', 'location', 'type'], required: true),
        ];
    }
}
