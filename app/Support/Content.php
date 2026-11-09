<?php

namespace App\Support;

use App\Models\Event;
use App\Models\Member;
use App\Models\News;
use App\Models\Region;
use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Public-site content, read from the admin-managed tables. Falls back to the
 * static config/uac.php data while a table is missing or still empty, so the
 * site keeps rendering before `php artisan migrate && php artisan static:seed`.
 */
class Content
{
    /** @return array<string, array> keyed by slug */
    public static function regions(): array
    {
        return self::fromTable(
            Region::class,
            fn () => Region::with('secretaries')->orderBy('sort_order')->get()
                ->mapWithKeys(fn (Region $region) => [$region->slug => $region->toFrontendArray()])
                ->all(),
            fn () => config('uac.regions', []),
        );
    }

    public static function region(string $slug): ?array
    {
        return self::regions()[$slug] ?? null;
    }

    public static function events(): array
    {
        return self::fromTable(
            Event::class,
            fn () => Event::orderBy('date')->get()->map->toFrontendArray()->all(),
            fn () => config('uac.events', []),
        );
    }

    /**
     * Events that have not happened yet, soonest first.
     *
     * Filtered on the date itself, not on the `is_past` column: that column is
     * only recomputed when a record is saved, so it goes stale the moment a
     * date passes with nobody editing the event. Both the database rows and the
     * static config store the date as a `Y-m-d` string, so one comparison
     * serves both sources.
     */
    public static function upcomingEvents(): array
    {
        return self::eventsOnOrAfter(true);
    }

    /** Events that have already happened, most recent first. */
    public static function pastEvents(): array
    {
        return array_reverse(self::eventsOnOrAfter(false));
    }

    private static function eventsOnOrAfter(bool $upcoming): array
    {
        $today = now()->toDateString();

        return array_values(array_filter(
            self::events(),
            fn (array $event) => $upcoming
                ? ($event['date'] ?? '') >= $today
                : ($event['date'] ?? '') < $today,
        ));
    }

    public static function news(int $limit = 3): array
    {
        return self::fromTable(
            News::class,
            fn () => News::orderByDesc('date')->take($limit)->get()->map->toFrontendArray()->all(),
            fn () => array_slice(config('uac.latest_news', []), 0, $limit),
        );
    }

    public static function newsItem(string $slug): ?array
    {
        return self::fromTable(
            News::class,
            fn () => News::where('slug', $slug)->first()?->toFrontendArray() ?? [],
            fn () => collect(config('uac.latest_news', []))->firstWhere('slug', $slug) ?? [],
        ) ?: null;
    }

    public static function members(): array
    {
        return self::fromTable(
            Member::class,
            fn () => Member::orderBy('sort_order')->orderBy('name')->get()->map->toFrontendArray()->all(),
            fn () => config('uac.members', []),
        );
    }

    public static function contactEmail(): string
    {
        return self::setting('contact.email') ?? config('uac.contact.email');
    }

    public static function socials(): array
    {
        return collect(config('uac.contact.socials', []))
            ->map(function (array $social) {
                $url = self::setting("social.{$social['platform']}");

                return $url ? [...$social, 'url' => $url] : $social;
            })
            ->all();
    }

    public static function heroCaption(): array
    {
        $dict = self::safely(
            fn () => SiteSetting::tablesReady() ? SiteSetting::dict('home.hero_caption') : [],
            [],
        );

        return array_filter($dict) ? i18n_dict($dict) : ui('pages.home.hero_image_caption');
    }

    private static function setting(string $key): ?string
    {
        $value = self::safely(
            fn () => SiteSetting::tablesReady() ? SiteSetting::get($key, 'en') : null,
            null,
        );

        return filled($value) && $value !== '#' ? $value : null;
    }

    /**
     * @param  class-string<Model>  $model
     */
    private static function fromTable(string $model, callable $fromDb, callable $fallback): array
    {
        $rows = self::safely(fn () => $model::query()->exists() ? $fromDb() : null, null);

        return $rows ?? $fallback();
    }

    private static function safely(callable $callback, mixed $default): mixed
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            Log::warning('Content falling back to static config: '.$e->getMessage());

            return $default;
        }
    }
}
