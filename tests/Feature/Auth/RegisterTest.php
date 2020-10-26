<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegisterpage()
    {
        $response = $this->get(route('register'));
        $response->assertSuccessful();
    }

    public function testRegister()
    {
        $user = factory(User::class)->make();
        $response = $this->post(route('register'),[
            'name' => $user->name,
            'account' => $user->account,
            'email' => $user->email,
            'password' => 'password', // default fake pwd
            'password_confirmation' => 'password',
        ]);

        // Direct to home page
        $response->assertRedirect(route('home'));

        // Assert that a table in the database contains the given data.
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'account' => $user->account,
            'email' => $user->email,
        ]);
        $this->assertTrue(
            Hash::check('password', User::where('email', $user->email)->first()->password)
        ); 
    }
}
