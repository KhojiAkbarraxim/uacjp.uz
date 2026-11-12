<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AdminTranslationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'services.azure_translator.key' => 'test-key',
            'services.azure_translator.region' => 'northeurope',
            'services.azure_translator.endpoint' => 'https://translator.test/',
        ]);
    }

    private function asAdmin(): static
    {
        return $this->withSession(['admin_authenticated' => true, 'admin_email' => 'admin@uacjp.uz']);
    }

    public function test_translates_uzbek_sent_in_the_old_alphabet(): void
    {
        Http::fake(['translator.test/*' => Http::response([[
            'translations' => [
                ['text' => 'Uzbek researchers: announcement', 'to' => 'en'],
                ['text' => 'ウズベク研究者：お知らせ', 'to' => 'ja'],
            ],
        ]])]);

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => 'Özbek tadqiqotçilari: eʼlon', 'to' => ['en', 'ja']])
            ->assertOk()
            ->assertExactJson(['translations' => [
                'en' => 'Uzbek researchers: announcement',
                'ja' => 'ウズベク研究者：お知らせ',
            ]]);

        Http::assertSent(fn (Request $request) => $request->url() === 'https://translator.test/translate?api-version=3.0&from=uz&to=en&to=ja'
            && $request->header('Ocp-Apim-Subscription-Key') === ['test-key']
            && $request->header('Ocp-Apim-Subscription-Region') === ['northeurope']
            && $request->data() === [['Text' => 'Oʻzbek tadqiqotchilari: eʼlon']]);
    }

    public function test_only_requested_locales_are_sent(): void
    {
        Http::fake(['translator.test/*' => Http::response([['translations' => [['text' => 'イベント', 'to' => 'ja']]]])]);

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => 'Tadbir', 'to' => ['ja']])
            ->assertOk()
            ->assertExactJson(['translations' => ['ja' => 'イベント']]);

        Http::assertSent(fn (Request $request) => str_ends_with($request->url(), 'from=uz&to=ja'));
    }

    public function test_rejects_the_source_language_as_a_target_and_empty_text(): void
    {
        Http::fake();

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => '', 'to' => ['uz']])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['text', 'to.0']);

        Http::assertNothingSent();
    }

    public function test_reports_a_failing_translation_service(): void
    {
        Http::fake(['translator.test/*' => Http::response(['error' => ['code' => 403000]], 403)]);

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => 'Salom', 'to' => ['en']])
            ->assertStatus(502);
    }

    public function test_reports_missing_configuration(): void
    {
        config(['services.azure_translator.key' => null]);
        Http::fake();

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => 'Salom', 'to' => ['en']])
            ->assertStatus(503);

        Http::assertNothingSent();
    }

    public function test_requires_admin_login(): void
    {
        Http::fake();

        $this->postJson(route('admin.translate'), ['text' => 'Salom', 'to' => ['en']])
            ->assertRedirect(route('admin.login'));

        Http::assertNothingSent();
    }
}
