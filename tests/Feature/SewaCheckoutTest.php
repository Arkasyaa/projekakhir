<?php

namespace Tests\Feature;

use Tests\TestCase;

class SewaCheckoutTest extends TestCase
{
    public function test_checkout_requires_authentication(): void
    {
        $this->post(route('sewa.checkout'))
            ->assertRedirect(route('login'));
    }
}
