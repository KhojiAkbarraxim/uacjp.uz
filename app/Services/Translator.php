<?php

namespace App\Services;

use Anthropic\Client;
use App\Support\Locales;
use RuntimeException;

/**
 * Translates a record from the language it was written in into the others.
 *
 * One call per record rather than one per field: it costs less and, more
 * importantly, keeps terminology consistent across a title, its summary and
 * its body. The model is asked for a JSON object shaped like the fields it was
 * given, so the response can be dropped straight into the form.
 */
class Translator
{
    public const MODEL = 'claude-opus-5-5';

    private const MAX_TOKENS = 8000;

    public function __construct(private Client $client) {}

    /** The languages produced from the authored one. */
    public static function targets(): array
    {
        return array_values(array_diff(Locales::ORDER, [Locales::SOURCE]));
    }

    /**
     * @param  array<string, string>  $fields  field name => Uzbek text
     * @param  string  $context  what the record is, e.g. "a news article"
     * @return array<string, array<string, string>>  locale => field => text
     */
    public function translate(array $fields, string $context = 'website content'): array
    {
        $fields = array_filter($fields, fn ($value) => filled($value));

        if ($fields === []) {
            return [];
        }

        $message = $this->client->messages->create(
            model: self::MODEL,
            maxTokens: self::MAX_TOKENS,
            system: $this->systemPrompt($context),
            // Translation does not reward deep reasoning, and effort is the
            // only lever on this model - thinking cannot be switched off.
            outputConfig: ['effort' => 'low', 'format' => $this->schema(array_keys($fields))],
            messages: [[
                'role' => 'user',
                'content' => json_encode($fields, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            ]],
        );

        return $this->decode($message, array_keys($fields));
    }

    private function systemPrompt(string $context): string
    {
        $targets = implode(' and ', array_map(
            fn (string $locale) => match ($locale) {
                'en' => 'English',
                'ja' => 'Japanese',
                default => $locale,
            },
            self::targets(),
        ));

        return <<<PROMPT
        You translate {$context} for the Uzbek Academic Club in Japan (UAC Japan),
        an association of Uzbek researchers and students at Japanese universities.

        The input is a JSON object of Uzbek fields. Translate every value into
        {$targets} and return one object per language, keyed by field name.

        The Uzbek uses the current alphabet, where o, g, s and c carry marks:
        ö is the vowel written oʻ in the older spelling, ğ is gʻ, ş is sh and
        ç is ch. Read them that way. The modifier apostrophe (ʼ) marks a glottal
        stop and is not a quotation mark.

        Rules:
        - Do not translate names: "UAC Japan", universities, cities, and people.
        - Keep paragraph breaks, line breaks and any list structure exactly.
        - English: clear academic prose, no padding.
        - Japanese: polite written form (です・ます), natural rather than literal.
        - Translate only. Never add, explain, summarise or omit anything.
        PROMPT;
    }

    /** @param  array<int, string>  $fields */
    private function schema(array $fields): array
    {
        $perLocale = [
            'type' => 'object',
            'properties' => array_fill_keys($fields, ['type' => 'string']),
            'required' => $fields,
            'additionalProperties' => false,
        ];

        $targets = self::targets();

        return [
            'type' => 'json_schema',
            'schema' => [
                'type' => 'object',
                'properties' => array_fill_keys($targets, $perLocale),
                'required' => $targets,
                'additionalProperties' => false,
            ],
        ];
    }

    /** @param  array<int, string>  $fields */
    private function decode(object $message, array $fields): array
    {
        foreach ($message->content as $block) {
            if (($block->type ?? null) !== 'text') {
                continue;
            }

            $decoded = json_decode($block->text, true);

            if (! is_array($decoded)) {
                break;
            }

            return collect(self::targets())
                ->mapWithKeys(fn (string $locale) => [
                    $locale => collect($fields)
                        ->mapWithKeys(fn (string $field) => [$field => (string) ($decoded[$locale][$field] ?? '')])
                        ->all(),
                ])
                ->all();
        }

        throw new RuntimeException('The translation response did not contain usable JSON.');
    }
}
