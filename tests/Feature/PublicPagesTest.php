<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_public_pages_render_successfully(): void
    {
        $routes = [
            '/',
            '/regions',
            '/regions/kanto',
            '/news',
            '/activities',
            '/members',
            '/members/secretary',
            '/about',
            '/partners',
            '/contact',
            '/join',
            '/news/2024-05-27-first-meeting-of-the-year',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk()->assertDontSee('href="#"', false);
        }
    }

    public function test_members_page_lists_the_officers_and_not_the_old_samples(): void
    {
        $this->get('/members')
            ->assertOk()
            ->assertSee('Umirdinov Alisher')
            ->assertSee('Otabek Buriev')
            ->assertSee('Nodira Umaralieva')
            ->assertDontSee('Dilshod Abdullaev');
    }

    public function test_hero_has_no_become_partner_button(): void
    {
        // The partner CTA stays in the closing block, so it must still appear once.
        $home = $this->get('/')->assertOk();

        $this->assertSame(1, substr_count($home->getContent(), 'data-i18n-en="Become a Partner"'));
    }

    public function test_unknown_news_returns_not_found(): void
    {
        $this->get('/news/no-such-article')->assertNotFound();
    }

    public function test_unknown_region_returns_not_found(): void
    {
        $this->get('/regions/unknown-region')->assertNotFound();
    }
}
