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

    public function test_translates_uzbek_sent_in_the_old_alphabet_and_rewrites_the_source(): void
    {
        Http::fake(['translator.test/*' => Http::response([[
            'translations' => [
                ['text' => 'Uzbek researchers: announcement', 'to' => 'en'],
                ['text' => 'ウズベク研究者：お知らせ', 'to' => 'ja'],
            ],
        ]])]);

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => "O'zbek tadqiqotchilari: e'lon", 'to' => ['en', 'ja']])
            ->assertOk()
            ->assertExactJson(['translations' => [
                'uz' => 'Özbek tadqiqotçilari: eʼlon',
                'en' => 'Uzbek researchers: announcement',
                'ja' => 'ウズベク研究者：お知らせ',
            ]]);

        Http::assertSent(fn (Request $request) => $request->url() === 'https://translator.test/translate?api-version=3.0&from=uz&to=en&to=ja'
            && $request->header('Ocp-Apim-Subscription-Key') === ['test-key']
            && $request->header('Ocp-Apim-Subscription-Region') === ['northeurope']
            && $request->data() === [['Text' => "O'zbek tadqiqotchilari: e'lon"]]);
    }

    public function test_only_requested_locales_are_sent(): void
    {
        Http::fake(['translator.test/*' => Http::response([['translations' => [['text' => 'イベント', 'to' => 'ja']]]])]);

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => 'Tadbir', 'to' => ['ja']])
            ->assertOk()
            ->assertExactJson(['translations' => ['uz' => 'Tadbir', 'ja' => 'イベント']]);

        Http::assertSent(fn (Request $request) => str_ends_with($request->url(), 'from=uz&to=ja'));
    }

    public function test_rewrites_the_alphabet_without_a_target_or_a_configured_key(): void
    {
        config(['services.azure_translator.key' => null]);
        Http::fake();

        $this->asAdmin()
            ->postJson(route('admin.translate'), ['text' => "G'alaba kuni, o'qituvchi"])
            ->assertOk()
            ->assertExactJson(['translations' => ['uz' => 'Ğalaba kuni, öqituvçi']]);

        Http::assertNothingSent();
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

    public function test_reports_missing_configuration_only_when_a_target_is_requested(): void
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
