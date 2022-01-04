<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function authenticating_user()
    {
        $data = [
            'email'    => 'akhmedovmirik@gmail.com',
            'password' => '123123'
        ];
        $this->postJson(route('auth.login-action', $data))
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs(User::first());
    }
}