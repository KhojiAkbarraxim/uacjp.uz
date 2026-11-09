<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StaticSeedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * `static:seed` is re-runnable, so it must be additive. It used to wipe each
     * region's secretaries before re-creating them from config, which destroyed
     * anyone an admin had added through the panel.
     */
    public function test_re_seeding_keeps_secretaries_added_in_the_admin(): void
    {
        $this->artisan('static:seed')->assertSuccessful();

        $region = Region::firstOrFail();
        $seededCount = $region->secretaries()->count();

        $region->secretaries()->create([
            'name' => 'Admin Added Person',
            'role_en' => 'Coordinator',
            'email' => 'coordinator@example.com',
        ]);

        $this->artisan('static:seed')->assertSuccessful();

        $this->assertDatabaseHas('region_secretaries', [
            'region_id' => $region->id,
            'name' => 'Admin Added Person',
        ]);

        // The config-sourced secretaries are updated in place, not duplicated.
        $this->assertSame($seededCount + 1, $region->secretaries()->count());
    }
}
