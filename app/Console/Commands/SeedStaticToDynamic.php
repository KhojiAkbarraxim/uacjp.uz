<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Region;
use App\Models\SiteSetting;
use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SeedStaticToDynamic extends Command
{
    protected $signature = 'static:seed';
    protected $description = 'Migrate static config data to dynamic database tables';

    public function handle()
    {
        $config = config('uac');

        // Seed regions
        foreach ($config['regions'] as $regionData) {
            $region = Region::create([
                'slug' => $this->slugify($regionData['name']['en']),
                'name_en' => $regionData['name']['en'],
                'name_uz' => $regionData['name']['uz'] ?? null,
                'name_ja' => $regionData['name']['ja'] ?? null,
                'short_name_en' => $regionData['short_name']['en'] ?? $regionData['name']['en'],
                'status' => 'Active',
                'members_count' => $regionData['members_count'],
                'email' => $regionData['email'] ?? null,
                'phone' => $regionData['phone'] ?? null,
                'city_en' => $regionData['city'] ?? null,
                'locations' => $regionData['locations'] ?? null,
            ]);

            foreach ($regionData['secretaries'] ?? [] as $sec) {
                $region->secretaries()->create([
                    'name' => $sec['name'],
                    'role_en' => $sec['role'] ?? null,
                    'email' => $sec['email'] ?? null,
                    'phone' => $sec['phone'] ?? null,
                ]);
            }

            $this->info("Created region: {$region->name_en}");
        }

        // Seed events
        foreach ($config['events'] as $eventData) {
            Event::create([
                'title_en' => $eventData['title']['en'],
                'title_uz' => $eventData['title']['uz'] ?? null,
                'title_ja' => $eventData['title']['ja'] ?? null,
                'date' => $eventData['date'],
                'location_en' => $eventData['location']['en'],
                'location_uz' => $eventData['location']['uz'] ?? null,
                'location_ja' => $eventData['location']['ja'] ?? null,
                'type_en' => $eventData['type']['en'],
                'type_uz' => $eventData['type']['uz'] ?? null,
                'type_ja' => $eventData['type']['ja'] ?? null,
                'is_past' => false,
            ]);
            $this->info("Created event: {$eventData['title']['en']}");
        }

        // Seed site settings (social links, hero text)
        $socials = collect($config['contact']['socials'] ?? [])->pluck('url', 'label')->toArray();
        SiteSetting::set('site.socials', json_encode($socials), 'en');

        $heroTexts = [
            'en' => 'A platform for scholars, researchers, alumni, and partners building long-term academic impact.',
            'uz' => 'Uzoq muddatli ilmiy ta′ir yaratayotgan olimlar, tadqiqotchilar, bitiruvchilar va hamkorlar uchun platforma.',
            'ja' => '長期的な学術的インパクトを築く研究者・卒業生・パートナーのためのプラットフォーム。',
        ];
        SiteSetting::set('home.hero_caption', $heroTexts['en'], 'en');
        SiteSetting::set('home.hero_caption', $heroTexts['uz'], 'uz');
        SiteSetting::set('home.hero_caption', $heroTexts['ja'], 'ja');

        $this->info('Static data migrated to database tables.');
        return 0;
    }

    private function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~\-+~', '-', $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}
