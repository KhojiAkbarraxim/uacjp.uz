<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TranslateRequest extends FormRequest
{
    /** Caps on what one click may send - this is where the cost is bounded. */
    private const MAX_FIELDS = 12;

    private const MAX_CHARS = 20000;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fields' => ['required', 'array', 'min:1', 'max:'.self::MAX_FIELDS],
            'fields.*' => ['nullable', 'string'],
            'context' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $total = collect($this->input('fields', []))
                ->sum(fn ($value) => is_scalar($value) ? mb_strlen((string) $value) : 0);

            if ($total > self::MAX_CHARS) {
                $validator->errors()->add('fields', 'Too much text to translate in one go.');
            }
        });
    }

    /** @return array<string, string> */
    public function fields(): array
    {
        return collect($this->validated()['fields'])
            ->filter(fn ($value) => filled($value))
            ->map(fn ($value) => (string) $value)
            ->all();
    }
}
