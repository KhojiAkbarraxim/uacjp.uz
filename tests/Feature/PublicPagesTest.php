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
            '/activities',
            '/members',
            '/members/secretary',
            '/about',
            '/partners',
            '/contact',
            '/join',
        ];

        foreach ($routes as $route) {
            $this->get($route)->assertOk();
        }
    }

    public function test_unknown_region_returns_not_found(): void
    {
        $this->get('/regions/unknown-region')->assertNotFound();
    }
}
