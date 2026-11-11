<?php

namespace Tests\Feature;

use App\Services\Translator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use RuntimeException;
use Tests\TestCase;

/**
 * The admin writes Uzbek and presses one button to fill English and Japanese.
 * Nothing here talks to the API: the service is swapped for a stand-in, so the
 * suite never spends money and never depends on the network.
 */
class TranslationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession(['admin_authenticated' => true, 'admin_email' => 'admin@uacjp.uz']);
        config(['services.anthropic.key' => 'test-key']);
    }

    private function fakeTranslator(): void
    {
        $this->instance(Translator::class, new class extends Translator
        {
            public function __construct() {}

            public function translate(array $fields, string $context = 'website content'): array
            {
                return [
                    'en' => collect($fields)->map(fn ($v) => "EN: {$v}")->all(),
                    'ja' => collect($fields)->map(fn ($v) => "JA: {$v}")->all(),
                ];
            }
        });
    }

    public function test_it_returns_a_translation_for_every_target_language(): void
    {
        $this->fakeTranslator();

        $this->postJson(route('admin.translate'), [
            'fields' => ['title' => 'Yığılış', 'summary' => 'Qisqa tavsif.'],
            'context' => 'a news article',
        ])->assertOk()->assertJson([
            'translations' => [
                'en' => ['title' => 'EN: Yığılış', 'summary' => 'EN: Qisqa tavsif.'],
                'ja' => ['title' => 'JA: Yığılış', 'summary' => 'JA: Qisqa tavsif.'],
            ],
        ]);
    }

    public function test_it_is_closed_to_anyone_not_signed_in(): void
    {
        $this->flushSession();

        $this->post(route('admin.translate'), ['fields' => ['title' => 'Salom']])
            ->assertRedirect(route('admin.login'));
    }

    public function test_it_caps_what_one_click_can_send(): void
    {
        $this->fakeTranslator();

        $this->postJson(route('admin.translate'), ['fields' => []])
            ->assertStatus(422)->assertJsonValidationErrors('fields');

        $this->postJson(route('admin.translate'), [
            'fields' => ['body' => str_repeat('a', 20001)],
        ])->assertStatus(422)->assertJsonValidationErrors('fields');
    }

    /** A failure must be reported, never surfaced as a 500 page. */
    public function test_a_failing_api_call_is_reported_not_thrown(): void
    {
        $this->instance(Translator::class, new class extends Translator
        {
            public function __construct() {}

            public function translate(array $fields, string $context = 'website content'): array
            {
                throw new RuntimeException('upstream is down');
            }
        });

        $this->postJson(route('admin.translate'), ['fields' => ['title' => 'Yığılış']])
            ->assertStatus(502)
            ->assertJsonStructure(['message']);
    }

    public function test_without_a_key_the_endpoint_declines_and_the_button_is_hidden(): void
    {
        config(['services.anthropic.key' => null]);

        $this->postJson(route('admin.translate'), ['fields' => ['title' => 'Yığılış']])
            ->assertStatus(503);

        $this->get(route('admin.news.create'))
            ->assertOk()
            ->assertDontSee('Translate into English and Japanese');
    }

    public function test_the_button_is_offered_on_every_form_that_has_translatable_fields(): void
    {
        foreach (['admin.news.create', 'admin.events.create', 'admin.members.create', 'admin.regions.create'] as $route) {
            $this->get(route($route))
                ->assertOk()
                ->assertSee('Translate into English and Japanese');
        }
    }
}
