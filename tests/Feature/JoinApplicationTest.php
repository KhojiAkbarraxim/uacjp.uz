<?php

namespace Tests\Feature;

use App\Mail\JoinApplicationReceived;
use App\Models\JoinApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class JoinApplicationTest extends TestCase
{
    use RefreshDatabase;

    private array $payload = [
        'name' => 'Aziz Karimov',
        'email' => 'aziz@example.com',
        'membership_type' => 'Student',
        'region' => 'Kanto',
        'affiliation' => 'University of Tokyo',
        'message' => 'I would like to join.',
    ];

    public function test_application_is_saved_and_the_admin_is_notified(): void
    {
        Mail::fake();

        $this->post('/join/apply', $this->payload)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('join_applications', [
            'email' => 'aziz@example.com',
            'status' => 'pending',
        ]);

        Mail::assertSent(JoinApplicationReceived::class);
    }

    /**
     * The row is written before the notification goes out. A broken or
     * unconfigured mailer must not turn a saved application into an error the
     * applicant reads as "it did not work" - which is what used to happen.
     */
    public function test_a_failing_mailer_does_not_break_the_submission(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP is down'));

        $this->post('/join/apply', $this->payload)
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('join_applications', ['email' => 'aziz@example.com']);
    }

    public function test_invalid_submissions_are_rejected(): void
    {
        $this->post('/join/apply', ['name' => '', 'email' => 'not-an-email'])
            ->assertSessionHasErrors(['name', 'email', 'membership_type', 'region']);

        $this->assertDatabaseCount('join_applications', 0);
    }

    public function test_admin_can_open_an_application_and_change_its_status(): void
    {
        $application = JoinApplication::create([...$this->payload, 'status' => 'pending']);

        $this->withSession(['admin_authenticated' => true])
            ->get("/admin/join-applications/{$application->id}")
            ->assertOk()
            ->assertSee('Aziz Karimov');

        $this->withSession(['admin_authenticated' => true])
            ->patch("/admin/join-applications/{$application->id}/status", ['status' => 'approved'])
            ->assertRedirect();

        $this->assertSame('approved', $application->fresh()->status);
    }

    public function test_applications_are_not_public(): void
    {
        $application = JoinApplication::create([...$this->payload, 'status' => 'pending']);

        $this->get('/admin/join-applications')->assertRedirect(route('admin.login'));
        $this->get("/admin/join-applications/{$application->id}")->assertRedirect(route('admin.login'));
    }
}
