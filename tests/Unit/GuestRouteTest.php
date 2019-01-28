<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestRouteTest extends TestCase
{


    public function testHomeRoute()
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSeeInOrder(['Email Address:', 'Password:','Remember me', 'Login']);
        $response->assertDontSeeText('Register');
        $response->assertDontSeeText('register');
        $response->assertDontSeeText('signup');
    }

    public function testLgaRoute() {
        $response = $this->get('/admin/users/lga');
        $response->assertStatus(302);
    }

    public function testLoginUser(){
        //Create new user and attempt Login
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/admin/users/lga');
        $response->assertSuccessful();
    }

    public function testAdminRoute(){
        //Attempt accessing admin dashboard as a guest
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
        $response->assertDontSeeText('Dasboard');
        $response->assertDontSeeText('dashboard');
        $response->assertStatus(302);
    }

    public function testRegisterRoute() {
        //Verify that register url redirects to login route
        $response = $this->get('/register');
        $response->assertRedirect('/login');
    }



}
