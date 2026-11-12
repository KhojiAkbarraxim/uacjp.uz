<?php

namespace App\Services;

use App\Support\UzbekLatin;
use Illuminate\Support\Facades\Http;

class Translator
{
    public static function configured(): bool
    {
        return filled(config('services.azure_translator.key'));
    }

    /**
     * @param  array<int, string>  $to
     * @return array<string, string> translated text keyed by target locale
     */
    public function translate(string $text, string $from, array $to): array
    {
        $config = config('services.azure_translator');

        $query = http_build_query(['api-version' => '3.0', 'from' => $from]);
        foreach ($to as $locale) {
            $query .= '&to='.urlencode($locale);
        }

        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => $config['key'],
            'Ocp-Apim-Subscription-Region' => $config['region'],
        ])
            ->timeout(15)
            // Azure reads the new Uzbek alphabet, but translates the old one noticeably better.
            ->post(rtrim($config['endpoint'], '/').'/translate?'.$query, [['Text' => $from === 'uz' ? UzbekLatin::toOld($text) : $text]])
            ->throw();

        $translations = [];
        foreach ($response->json('0.translations', []) as $item) {
            $translations[$item['to']] = $item['to'] === 'uz'
                ? UzbekLatin::toDisplay($item['text'])
                : $item['text'];
        }

        return $translations;
    }
}
