<?php

namespace Tests\Feature;

use App\Mail\ContactMessageReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private array $payload = [
        'name' => 'Sakura Tanaka',
        'email' => 'sakura@example.com',
        'topic' => 'General enquiry',
        'message' => 'Hello, I have a question about the club.',
    ];

    public function test_the_form_posts_to_a_real_endpoint(): void
    {
        $this->get('/contact')
            ->assertOk()
            ->assertSee(route('contact.send'))
            ->assertSee('name="_token"', false);
    }

    public function test_a_message_is_sent_to_the_club_address(): void
    {
        Mail::fake();

        $this->post('/contact/send', $this->payload)
            ->assertRedirect()
            ->assertSessionHas('success');

        Mail::assertSent(ContactMessageReceived::class);
    }

    public function test_invalid_input_is_rejected_and_kept(): void
    {
        Mail::fake();

        $this->from('/contact')
            ->post('/contact/send', ['name' => 'Sakura', 'email' => 'nope', 'message' => ''])
            ->assertRedirect('/contact')
            ->assertSessionHasErrors(['email', 'message']);

        Mail::assertNothingSent();
    }

    public function test_a_failing_mailer_tells_the_visitor_instead_of_500ing(): void
    {
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP is down'));

        $this->post('/contact/send', $this->payload)
            ->assertRedirect()
            ->assertSessionHas('error');
    }
}
