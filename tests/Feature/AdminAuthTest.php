<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['admin.email' => 'admin@uacjp.uz', 'admin.password' => Hash::make('correct-horse')]);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        foreach (['/admin/dashboard', '/admin/regions', '/admin/members', '/admin/events', '/admin/news', '/admin/settings'] as $url) {
            $this->get($url)->assertRedirect(route('admin.login'));
        }
    }

    public function test_admin_can_log_in_with_hashed_password(): void
    {
        $this->post(route('admin.login.authenticate'), ['email' => 'admin@uacjp.uz', 'password' => 'correct-horse'])
            ->assertRedirect(route('admin.dashboard'));

        $this->get('/admin/dashboard')->assertOk();
    }

    public function test_plain_text_password_is_supported(): void
    {
        config(['admin.password' => 'plain-secret']);

        $this->post(route('admin.login.authenticate'), ['email' => 'admin@uacjp.uz', 'password' => 'plain-secret'])
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_wrong_password_is_rejected(): void
    {
        $this->post(route('admin.login.authenticate'), ['email' => 'admin@uacjp.uz', 'password' => 'nope'])
            ->assertSessionHasErrors('email');

        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
    }

    public function test_login_is_disabled_when_no_password_is_configured(): void
    {
        config(['admin.password' => null]);

        $this->post(route('admin.login.authenticate'), ['email' => 'admin@uacjp.uz', 'password' => ''])
            ->assertSessionHasErrors();
    }

    public function test_admin_is_sent_back_to_the_page_they_wanted(): void
    {
        $this->get('/admin/members');

        $this->post(route('admin.login.authenticate'), ['email' => 'admin@uacjp.uz', 'password' => 'correct-horse'])
            ->assertRedirect(url('/admin/members'));
    }

    public function test_logout_ends_the_session(): void
    {
        $this->withSession(['admin_authenticated' => true])
            ->post(route('admin.logout'))
            ->assertRedirect(route('home'));

        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
    }
}
