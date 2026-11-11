<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Member;
use App\Models\News;
use App\Models\Region;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedStaticToDynamic extends Command
{
    protected $signature = 'static:seed';
    protected $description = 'Migrate static config data to dynamic database tables';

    public function handle()
    {
        $config = config('uac');

        $this->seedRegions($config['regions'] ?? []);
        $this->seedEvents($config['events'] ?? []);
        $this->seedNews($config['latest_news'] ?? []);
        $this->seedMembers($config['members'] ?? []);
        $this->seedSettings($config);

        $this->info('Static data migrated to database tables.');

        return 0;
    }

    private function seedRegions(array $regions): void
    {
        $sort = 0;

        foreach ($regions as $slug => $regionData) {
            $sort++;
            $region = Region::updateOrCreate(
                ['slug' => $regionData['slug'] ?? $slug],
                [
                    'name_en' => $regionData['name']['en'] ?? null,
                    'name_uz' => $regionData['name']['uz'] ?? null,
                    'name_ja' => $regionData['name']['ja'] ?? null,
                    'short_name_en' => $regionData['short_name']['en'] ?? ($regionData['name']['en'] ?? null),
                    'short_name_uz' => $regionData['short_name']['uz'] ?? null,
                    'short_name_ja' => $regionData['short_name']['ja'] ?? null,
                    'status_en' => $this->i18n($regionData['status'] ?? null, 'en'),
                    'status_uz' => $this->i18n($regionData['status'] ?? null, 'uz'),
                    'status_ja' => $this->i18n($regionData['status'] ?? null, 'ja'),
                    'members_count_en' => $this->i18n($regionData['members_count'] ?? null, 'en'),
                    'members_count_uz' => $this->i18n($regionData['members_count'] ?? null, 'uz'),
                    'members_count_ja' => $this->i18n($regionData['members_count'] ?? null, 'ja'),
                    'summary_en' => $this->i18n($regionData['summary'] ?? null, 'en'),
                    'summary_uz' => $this->i18n($regionData['summary'] ?? null, 'uz'),
                    'summary_ja' => $this->i18n($regionData['summary'] ?? null, 'ja'),
                    'excerpt_en' => $this->i18n($regionData['excerpt'] ?? null, 'en'),
                    'excerpt_uz' => $this->i18n($regionData['excerpt'] ?? null, 'uz'),
                    'excerpt_ja' => $this->i18n($regionData['excerpt'] ?? null, 'ja'),
                    'about_en' => $this->i18n($regionData['about'] ?? null, 'en'),
                    'about_uz' => $this->i18n($regionData['about'] ?? null, 'uz'),
                    'about_ja' => $this->i18n($regionData['about'] ?? null, 'ja'),
                    'image' => $regionData['image'] ?? null,
                    'hero_image' => $regionData['hero_image'] ?? null,
                    'email' => $regionData['contact']['email'] ?? ($regionData['email'] ?? null),
                    'phone' => $regionData['contact']['phone'] ?? ($regionData['phone'] ?? null),
                    'city_en' => $this->i18n($regionData['contact']['city'] ?? ($regionData['city'] ?? null), 'en'),
                    'city_uz' => $this->i18n($regionData['contact']['city'] ?? ($regionData['city'] ?? null), 'uz'),
                    'city_ja' => $this->i18n($regionData['contact']['city'] ?? ($regionData['city'] ?? null), 'ja'),
                    'locations_en' => $this->i18n($regionData['locations'] ?? null, 'en'),
                    'locations_uz' => $this->i18n($regionData['locations'] ?? null, 'uz'),
                    'locations_ja' => $this->i18n($regionData['locations'] ?? null, 'ja'),
                    'universities' => $regionData['universities'] ?? [],
                    'activities' => $regionData['activities'] ?? [],
                    'gallery' => $regionData['gallery'] ?? [],
                    'plans' => $regionData['plans'] ?? [],
                    'sort_order' => $sort,
                ]
            );

            // Seeding is additive on purpose. Wiping the relation here would
            // destroy secretaries an admin added through the panel, and this
            // command is re-runnable. RegionController does delete-then-recreate,
            // but there the submitted form IS the full list, so it is authoritative;
            // the static config is not.
            foreach ($regionData['secretaries'] ?? [] as $sec) {
                $region->secretaries()->updateOrCreate(
                    ['name' => $sec['name']],
                    [
                        'role_en' => $this->i18n($sec['role'] ?? null, 'en'),
                        'role_uz' => $this->i18n($sec['role'] ?? null, 'uz'),
                        'role_ja' => $this->i18n($sec['role'] ?? null, 'ja'),
                        'affiliation_en' => $this->i18n($sec['affiliation'] ?? null, 'en'),
                        'affiliation_uz' => $this->i18n($sec['affiliation'] ?? null, 'uz'),
                        'affiliation_ja' => $this->i18n($sec['affiliation'] ?? null, 'ja'),
                        'email' => $sec['email'] ?? null,
                        'phone' => $sec['phone'] ?? null,
                        'telegram' => $sec['telegram'] ?? null,
                    ]
                );
            }

            $this->info("Created region: {$region->name_en}");
        }
    }

    private function seedEvents(array $events): void
    {
        foreach ($events as $eventData) {
            Event::updateOrCreate(
                [
                    'title_en' => $eventData['title']['en'],
                    'date' => $eventData['date'],
                ],
                [
                    'title_uz' => $eventData['title']['uz'] ?? null,
                    'title_ja' => $eventData['title']['ja'] ?? null,
                    'location_en' => $this->i18n($eventData['location'] ?? null, 'en'),
                    'location_uz' => $this->i18n($eventData['location'] ?? null, 'uz'),
                    'location_ja' => $this->i18n($eventData['location'] ?? null, 'ja'),
                    'type_en' => $this->i18n($eventData['type'] ?? null, 'en'),
                    'type_uz' => $this->i18n($eventData['type'] ?? null, 'uz'),
                    'type_ja' => $this->i18n($eventData['type'] ?? null, 'ja'),
                    'image' => $eventData['image'] ?? null,
                    'is_past' => Carbon::parse($eventData['date'])->isPast(),
                ]
            );
            $this->info('Created event: '.$eventData['title']['en']);
        }
    }

    private function seedNews(array $items): void
    {
        foreach ($items as $item) {
            News::updateOrCreate(
                ['slug' => $item['slug'] ?? Str::slug($item['title']['en'])],
                [
                    'title_en' => $item['title']['en'],
                    'title_uz' => $item['title']['uz'] ?? null,
                    'title_ja' => $item['title']['ja'] ?? null,
                    'type_en' => $this->i18n($item['type'] ?? null, 'en'),
                    'type_uz' => $this->i18n($item['type'] ?? null, 'uz'),
                    'type_ja' => $this->i18n($item['type'] ?? null, 'ja'),
                    'date' => Carbon::parse($item['date']['en'] ?? $item['date']),
                    'summary_en' => $this->i18n($item['summary'] ?? null, 'en'),
                    'summary_uz' => $this->i18n($item['summary'] ?? null, 'uz'),
                    'summary_ja' => $this->i18n($item['summary'] ?? null, 'ja'),
                    'body_en' => $this->i18n($item['body'] ?? null, 'en'),
                    'body_uz' => $this->i18n($item['body'] ?? null, 'uz'),
                    'body_ja' => $this->i18n($item['body'] ?? null, 'ja'),
                    'image' => $item['image'] ?? null,
                ]
            );
            $this->info('Created news: '.$item['title']['en']);
        }
    }

    private function seedMembers(array $members): void
    {
        $sort = 0;

        foreach ($members as $member) {
            $sort++;
            Member::updateOrCreate(
                [
                    'name' => $member['name'],
                    'region_slug' => $member['region_slug'] ?? null,
                ],
                [
                    'photo' => $member['photo'] ?? null,
                    'role_en' => $this->i18n($member['role'] ?? null, 'en'),
                    'role_uz' => $this->i18n($member['role'] ?? null, 'uz'),
                    'role_ja' => $this->i18n($member['role'] ?? null, 'ja'),
                    'affiliation_en' => $this->i18n($member['affiliation'] ?? null, 'en'),
                    'affiliation_uz' => $this->i18n($member['affiliation'] ?? null, 'uz'),
                    'affiliation_ja' => $this->i18n($member['affiliation'] ?? null, 'ja'),
                    'bio_en' => $this->i18n($member['bio'] ?? null, 'en'),
                    'bio_uz' => $this->i18n($member['bio'] ?? null, 'uz'),
                    'bio_ja' => $this->i18n($member['bio'] ?? null, 'ja'),
                    'field_en' => $this->i18n($member['field'] ?? null, 'en'),
                    'field_uz' => $this->i18n($member['field'] ?? null, 'uz'),
                    'field_ja' => $this->i18n($member['field'] ?? null, 'ja'),
                    'field_slug' => $member['field_slug'] ?? Str::slug($this->i18n($member['field'] ?? null, 'en') ?? ''),
                    'region_en' => $this->i18n($member['region'] ?? null, 'en'),
                    'region_uz' => $this->i18n($member['region'] ?? null, 'uz'),
                    'region_ja' => $this->i18n($member['region'] ?? null, 'ja'),
                    'type' => $member['type'] ?? 'Staff',
                    'sort_order' => $member['sort_order'] ?? $sort,
                ]
            );
            $this->info('Created member: '.$member['name']);
        }
    }

    private function seedSettings(array $config): void
    {
        SiteSetting::set('contact.email', $config['contact']['email'] ?? 'hello@uacjp.uz', 'en');

        $socials = collect($config['contact']['socials'] ?? []);
        SiteSetting::set('social.facebook', $socials->firstWhere('platform', 'facebook')['url'] ?? '#', 'en');
        SiteSetting::set('social.telegram', $socials->firstWhere('platform', 'telegram')['url'] ?? '#', 'en');

        $hero = ui('pages.home.hero_image_caption');
        SiteSetting::set('home.hero_caption', $hero['en'] ?? null, 'en');
        SiteSetting::set('home.hero_caption', $hero['uz'] ?? null, 'uz');
        SiteSetting::set('home.hero_caption', $hero['ja'] ?? null, 'ja');

        $this->info('Created site settings.');
    }

    private function i18n(mixed $value, string $locale): ?string
    {
        if (is_array($value)) {
            return $value[$locale] ?? $value['en'] ?? null;
        }

        return is_string($value) ? $value : null;
    }
}
