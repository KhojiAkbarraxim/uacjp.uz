<?php

namespace App\Models\Concerns;

trait HasLocaleFields
{
    public function localeField(string $base): array
    {
        return [
            'en' => $this->{$base.'_en'},
            'uz' => $this->{$base.'_uz'},
            'ja' => $this->{$base.'_ja'},
        ];
    }
}
