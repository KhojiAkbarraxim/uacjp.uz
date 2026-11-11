<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\MemberController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberTypesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withSession(['admin_authenticated' => true, 'admin_email' => 'admin@uacjp.uz']);
    }

    /**
     * The invariant that was broken: the admin offered six member types while
     * the public page rendered three, so a member could be saved into a bucket
     * that appears nowhere on the site.
     */
    public function test_every_type_the_admin_offers_is_rendered_on_the_members_page(): void
    {
        foreach (MemberController::TYPES as $i => $type) {
            $this->post(route('admin.members.store'), [
                'name' => "Type Probe {$i}",
                'type' => $type,
            ])->assertRedirect(route('admin.members.index'));
        }

        $response = $this->get('/members')->assertOk();

        foreach (MemberController::TYPES as $i => $type) {
            $response->assertSee("Type Probe {$i}", false);
        }
    }

    public function test_the_retired_types_are_rejected(): void
    {
        foreach (['Featured', 'General', 'Alumni'] as $legacy) {
            $this->post(route('admin.members.store'), ['name' => 'Legacy', 'type' => $legacy])
                ->assertSessionHasErrors('type');
        }

        $this->assertDatabaseCount('members', 0);
    }

    public function test_a_member_saved_without_a_type_lands_in_a_visible_bucket(): void
    {
        // The column default used to be General, which the page never renders.
        $this->assertContains(
            \App\Models\Member::create(['name' => 'No Type Given'])->fresh()->type,
            MemberController::TYPES,
        );
    }
}
