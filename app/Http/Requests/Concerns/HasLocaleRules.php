<?php

namespace App\Http\Requests\Concerns;

use App\Support\Locales;

trait HasLocaleRules
{
    /**
     * Rules for a set of {base}_{locale} triplets.
     *
     * Only the authored locale may be required: English and Japanese are filled
     * in afterwards by the translate button, so demanding them here would make
     * it impossible to save a record before translating it.
     *
     * @param  array<int, string>  $bases
     * @param  array<int, mixed>  $rules  applied to every locale
     */
    protected function localeRules(array $bases, array $rules = ['nullable', 'string', 'max:255'], bool $required = false): array
    {
        $out = [];

        foreach ($bases as $base) {
            foreach (Locales::ORDER as $locale) {
                $out["{$base}_{$locale}"] = $required && $locale === Locales::SOURCE
                    ? $this->asRequired($rules)
                    : $rules;
            }
        }

        return $out;
    }

    /** The value of a field in the language the admin writes in. */
    protected function sourceInput(string $base): ?string
    {
        return $this->input($base.'_'.Locales::SOURCE);
    }

    /** @param  array<int, mixed>  $rules */
    private function asRequired(array $rules): array
    {
        return array_values(array_merge(
            ['required'],
            array_filter($rules, fn ($rule) => $rule !== 'nullable'),
        ));
    }
}
