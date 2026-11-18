<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicLandingTest extends TestCase
{
    public function test_guest_navigation_links_to_public_landing_sections(): void
    {
        $this->get(route('landing'))
            ->assertOk()
            ->assertSee(route('landing') . '#katalog', false)
            ->assertSee(route('landing') . '#cara_sewa', false);
    }
}
