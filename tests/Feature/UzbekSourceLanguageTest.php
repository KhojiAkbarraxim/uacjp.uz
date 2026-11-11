<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\Region;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Content is authored in Uzbek; English and Japanese are translated from it
 * afterwards. Until this flip, English was required, slugs came from English,
 * and a list row with an empty English cell was silently thrown away.
 */
class UzbekSourceLanguageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession(['admin_authenticated' => true, 'admin_email' => 'admin@uacjp.uz']);
    }

    public function test_an_article_can_be_saved_in_uzbek_alone(): void
    {
        $this->post(route('admin.news.store'), [
            'title_uz' => 'Yığılış',
            'date' => '2026-05-01',
            'summary_uz' => 'Qisqa tavsif.',
        ])->assertRedirect(route('admin.news.index'));

        $news = News::sole();
        $this->assertNull($news->title_en);
        $this->assertSame('yigilis', $news->slug);

        // Nothing on the public side may break on the missing translations.
        $this->get('/news/yigilis')->assertOk()->assertSee('Yığılış');
        $this->get('/news')->assertOk()->assertSee('Yığılış');
        $this->get('/')->assertOk();
    }

    public function test_english_is_no_longer_required_but_uzbek_is(): void
    {
        $this->post(route('admin.news.store'), ['title_en' => 'English only', 'date' => '2026-05-01'])
            ->assertSessionHasErrors('title_uz');

        $this->post(route('admin.events.store'), ['title_en' => 'English only', 'date' => '2026-05-01'])
            ->assertSessionHasErrors(['title_uz', 'location_uz', 'type_uz']);

        $this->assertDatabaseCount('news', 0);
        $this->assertDatabaseCount('events', 0);
    }

    /**
     * Uzbek collapses onto ASCII much harder than English did - o, g, s and c
     * all lose their marks - so distinct titles produce the same slug.
     */
    public function test_a_generated_slug_that_is_taken_gets_numbered(): void
    {
        foreach (['Töğri', 'Togri', 'Toğri'] as $i => $title) {
            $this->post(route('admin.news.store'), [
                'title_uz' => $title,
                'date' => '2026-0'.($i + 1).'-01',
            ])->assertRedirect(route('admin.news.index'));
        }

        $this->assertSame(
            ['togri', 'togri-2', 'togri-3'],
            News::orderBy('id')->pluck('slug')->all(),
        );
    }

    public function test_a_slug_the_admin_typed_is_reported_not_renumbered(): void
    {
        News::create(['slug' => 'taken', 'title_uz' => 'Birinçi', 'date' => '2026-01-01']);

        $this->post(route('admin.news.store'), [
            'slug' => 'taken',
            'title_uz' => 'Ikkinçi',
            'date' => '2026-02-01',
        ])->assertSessionHasErrors('slug');

        $this->assertDatabaseCount('news', 1);
    }

    /** The unique index must survive the nullable-column migration. */
    public function test_duplicate_news_slugs_are_still_rejected_by_the_database(): void
    {
        News::create(['slug' => 'only-one', 'title_uz' => 'Birinçi', 'date' => '2026-01-01']);

        $this->expectException(QueryException::class);
        News::create(['slug' => 'only-one', 'title_uz' => 'Ikkinçi', 'date' => '2026-02-01']);
    }

    public function test_duplicate_region_slugs_are_still_rejected_by_the_database(): void
    {
        Region::create(['slug' => 'only-one', 'name_uz' => 'Birinçi', 'short_name_uz' => 'B']);

        $this->expectException(QueryException::class);
        Region::create(['slug' => 'only-one', 'name_uz' => 'Ikkinçi', 'short_name_uz' => 'I']);
    }

    /**
     * The region list textareas pair up by line number. English used to be the
     * spine, so a list written only in Uzbek came out empty.
     */
    public function test_a_list_written_only_in_uzbek_is_kept(): void
    {
        $this->post(route('admin.regions.store'), [
            'name_uz' => 'UAC Tohoku',
            'short_name_uz' => 'Tohoku',
            'plans_uz' => "Birinçi reja\nIkkinçi reja",
        ])->assertRedirect(route('admin.regions.index'));

        $plans = Region::sole()->plans;

        $this->assertCount(2, $plans);
        $this->assertSame('Birinçi reja', $plans[0]['uz']);
        $this->assertSame('Birinçi reja', $plans[0]['en']);
    }

    public function test_admin_search_finds_uzbek_text(): void
    {
        $this->post(route('admin.news.store'), ['title_uz' => 'Toşkentda uçraşuv', 'date' => '2026-05-01']);
        $this->post(route('admin.members.store'), [
            'name' => 'Aziz Karimov',
            'type' => 'Staff',
            'affiliation_uz' => 'Toşkent universiteti',
        ]);

        $this->get(route('admin.news.index', ['search' => 'Toşkentda']))->assertOk()->assertSee('Toşkentda uçraşuv');
        $this->get(route('admin.members.index', ['search' => 'Toşkent']))->assertOk()->assertSee('Aziz Karimov');
    }

    /**
     * A reader whose language is missing gets English, and Uzbek only when
     * English is missing too - never an empty heading.
     */
    public function test_a_missing_translation_falls_back_rather_than_rendering_empty(): void
    {
        $this->assertSame(
            ['en' => 'English', 'uz' => 'Özbekça', 'ja' => 'English'],
            i18n_dict(['en' => 'English', 'uz' => 'Özbekça', 'ja' => '']),
        );

        $this->assertSame(
            ['en' => 'Özbekça', 'uz' => 'Özbekça', 'ja' => 'Özbekça'],
            i18n_dict(['en' => null, 'uz' => 'Özbekça', 'ja' => '']),
        );
    }
}
