<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Member;
use App\Models\News;
use App\Models\Region;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    /** 1×1 transparent PNG, so uploads work without the GD extension. */
    private const PNG = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession(['admin_authenticated' => true, 'admin_email' => 'admin@uacjp.uz']);
    }

    public function test_seeded_content_screens_render(): void
    {
        $this->artisan('static:seed')->assertSuccessful();

        $region = Region::first();
        $member = Member::first();
        $event = Event::first();
        $news = News::first();

        foreach ([
            '/admin/dashboard', '/admin/settings',
            '/admin/regions', '/admin/regions/create', "/admin/regions/{$region->id}/edit",
            '/admin/members', '/admin/members/create', "/admin/members/{$member->id}/edit",
            '/admin/events', '/admin/events/create', "/admin/events/{$event->id}/edit",
            '/admin/news', '/admin/news/create', "/admin/news/{$news->id}/edit",
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get("/admin/regions/{$region->id}/edit")->assertSee($region->secretaries->first()->name);
    }

    public function test_region_can_be_created_with_secretaries_and_lists(): void
    {
        $this->post(route('admin.regions.store'), [
            'name_en' => 'UAC Shikoku',
            'short_name_en' => 'Shikoku',
            'universities_en' => "Ehime University\nKochi University",
            'universities_ja' => "愛媛大学\n高知大学",
            'activities' => '[{"title": {"en": "Meetup"}}]',
            'secretaries' => [
                ['name' => 'Jasur Aliev', 'role_en' => 'Regional Secretary', 'telegram' => '@jasur'],
                ['name' => ''],
            ],
        ])->assertRedirect(route('admin.regions.index'));

        $region = Region::where('slug', 'uac-shikoku')->firstOrFail();
        $this->assertSame(['en' => 'Kochi University', 'uz' => 'Kochi University', 'ja' => '高知大学'], $region->universities[1]);
        $this->assertSame('Meetup', $region->activities[0]['title']['en']);
        $this->assertSame(['Jasur Aliev'], $region->secretaries->pluck('name')->all());

        $this->get('/regions/uac-shikoku')->assertOk()->assertSee('UAC Shikoku')->assertSee('Jasur Aliev');
    }

    public function test_region_rejects_invalid_json_and_duplicate_slug(): void
    {
        Region::create(['slug' => 'kanto', 'name_en' => 'UAC Kanto', 'short_name_en' => 'Kanto']);

        $this->post(route('admin.regions.store'), [
            'slug' => 'kanto',
            'name_en' => 'Another',
            'short_name_en' => 'Another',
            'gallery' => '{not json',
        ])->assertSessionHasErrors(['slug', 'gallery']);
    }

    public function test_region_update_replaces_secretaries_and_delete_cascades(): void
    {
        $region = Region::create(['slug' => 'kansai', 'name_en' => 'UAC Kansai', 'short_name_en' => 'Kansai']);
        $region->secretaries()->create(['name' => 'Old Person']);

        $this->put(route('admin.regions.update', $region), [
            'slug' => 'kansai',
            'name_en' => 'UAC Kansai',
            'short_name_en' => 'Kansai',
            'secretaries' => [['name' => 'New Person']],
        ])->assertRedirect(route('admin.regions.index'));

        $this->assertSame(['New Person'], $region->fresh()->secretaries->pluck('name')->all());

        $this->delete(route('admin.regions.destroy', $region))->assertRedirect(route('admin.regions.index'));
        $this->assertDatabaseCount('region_secretaries', 0);
    }

    public function test_member_crud_generates_filter_keys(): void
    {
        $this->post(route('admin.members.store'), [
            'name' => 'Laylo Karimova',
            // The members page renders Executive / Ambassador / Staff; a member
            // saved under one of the legacy types would not appear at all.
            'type' => 'Executive',
            'field_en' => 'Data Science',
            'region_en' => 'Kanto',
        ])->assertRedirect(route('admin.members.index'));

        $member = Member::firstOrFail();
        $this->assertSame('data-science', $member->field_slug);
        $this->assertSame('kanto', $member->region_slug);

        $this->get('/members')->assertOk()->assertSee('Laylo Karimova');

        $this->put(route('admin.members.update', $member), ['name' => 'Laylo K.', 'type' => 'Staff'])->assertRedirect();
        $this->assertSame('Staff', $member->fresh()->type);

        $this->delete(route('admin.members.destroy', $member))->assertRedirect();
        $this->assertDatabaseCount('members', 0);
    }

    public function test_event_past_flag_follows_date(): void
    {
        $base = ['title_en' => 'Forum', 'location_en' => 'Tokyo', 'type_en' => 'Forum'];

        $this->post(route('admin.events.store'), $base + ['date' => now()->subDay()->toDateString()]);
        $this->post(route('admin.events.store'), $base + ['date' => now()->addMonth()->toDateString()]);

        $this->assertSame([true, false], Event::orderBy('date')->pluck('is_past')->all());
        $this->get('/activities')->assertOk()->assertSee('Forum');
    }

    public function test_news_image_upload_is_stored_and_removed(): void
    {
        $this->post(route('admin.news.store'), [
            'title_en' => 'Big Announcement',
            'date' => '2026-11-01',
            'image_file' => UploadedFile::fake()->createWithContent('cover.png', base64_decode(self::PNG)),
        ])->assertRedirect(route('admin.news.index'));

        $news = News::firstOrFail();
        $this->assertStringStartsWith('uploads/news/', $news->image);
        $this->assertFileExists(public_path($news->image));

        $this->get('/')->assertOk()->assertSee('Big Announcement');

        $this->delete(route('admin.news.destroy', $news));
        $this->assertFileDoesNotExist(public_path($news->image));
    }

    public function test_news_article_page_shows_full_text(): void
    {
        $this->post(route('admin.news.store'), [
            'title_en' => 'Spring Meetup',
            'date' => '2026-04-01',
            'summary_en' => 'Short card text.',
            'body_en' => "First paragraph.\n\nSecond paragraph.",
        ])->assertRedirect(route('admin.news.index'));

        $this->assertSame('spring-meetup', News::firstOrFail()->slug);

        $this->get('/')->assertSee('Short card text.')->assertSee(route('news.show', 'spring-meetup'));
        $this->get('/news/spring-meetup')->assertOk()->assertSee('Second paragraph.');
    }

    public function test_static_seed_imports_the_real_article(): void
    {
        $this->artisan('static:seed')->assertSuccessful();

        $news = News::where('slug', '2024-05-27-first-meeting-of-the-year')->sole();
        $this->assertFileExists(public_path($news->image));
        $this->get('/news/'.$news->slug)->assertOk()->assertSee('Tsukuba');
    }

    public function test_settings_update_public_footer(): void
    {
        $this->put(route('admin.settings.update'), [
            'contact_email' => 'info@uacjp.uz',
            'social_telegram' => 'https://t.me/uacjp',
            'hero_caption_en' => 'Custom caption',
        ])->assertRedirect();

        $this->assertSame('info@uacjp.uz', SiteSetting::get('contact.email'));

        $this->get('/')->assertOk()
            ->assertSee('info@uacjp.uz')
            ->assertSee('https://t.me/uacjp')
            ->assertSee('Custom caption');
    }

    protected function tearDown(): void
    {
        File::deleteDirectory(public_path('uploads/news'));

        parent::tearDown();
    }
}
