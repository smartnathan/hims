<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    public function testCreateUserGuest()
    {
        $user = factory(User::class)->create();
        $user->assignRole('guest');

        $response = $this->actingAs($user)->get('/admin');
        $response->assertSuccessful();

    }
}
