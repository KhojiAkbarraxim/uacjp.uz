<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\Admin\MemberController;
use App\Http\Requests\Concerns\HasLocaleRules;
use App\Support\Images;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
{
    use HasLocaleRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // A person's name is not translated, so it has no locale triplet.
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(MemberController::TYPES)],
            'field_slug' => ['nullable', 'string', 'max:255'],
            'region_slug' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'photo_file' => Images::rules(),
            // No locale is required here: a member is identified by their name,
            // and the rest of the profile can be filled in over time.
            ...$this->localeRules(['role', 'affiliation', 'field', 'region']),
            ...$this->localeRules(['bio'], ['nullable', 'string']),
        ];
    }
}
