<?php

if (! function_exists('i18n_dict')) {
    function i18n_dict(array|string|null $value): array
    {
        if (is_array($value)) {
            return [
                'en' => $value['en'] ?? '',
                'uz' => $value['uz'] ?? $value['en'] ?? '',
                'ja' => $value['ja'] ?? $value['en'] ?? '',
            ];
        }

        return ['en' => $value ?? '', 'uz' => $value ?? '', 'ja' => $value ?? ''];
    }
}

if (! function_exists('i18n_text')) {
    function i18n_text(array|string|null $value, ?string $locale = null): string
    {
        $dict = i18n_dict($value);
        $locale ??= app()->getLocale();

        return $dict[$locale] ?? $dict['en'];
    }
}

if (! function_exists('ui')) {
    function ui(string $key): array
    {
        return i18n_dict(config("ui.{$key}"));
    }
}
