<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeEventsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The home page lists events under an "Upcoming events" heading, so an
     * event whose date has passed must not appear there. The filter runs on the
     * date rather than the stored `is_past` flag, which is only recomputed when
     * a record is saved and therefore goes stale on its own.
     */
    public function test_only_future_events_reach_the_home_page(): void
    {
        Event::create([
            'title_en' => 'Last Year Symposium',
            'date' => now()->subYear()->toDateString(),
            'location_en' => 'Tokyo',
            'type_en' => 'Symposium',
            // Deliberately wrong: a stale flag must not resurrect a past event.
            'is_past' => false,
        ]);

        Event::create([
            'title_en' => 'Next Year Workshop',
            'date' => now()->addYear()->toDateString(),
            'location_en' => 'Osaka',
            'type_en' => 'Workshop',
            'is_past' => false,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Next Year Workshop')
            ->assertDontSee('Last Year Symposium');
    }
}
