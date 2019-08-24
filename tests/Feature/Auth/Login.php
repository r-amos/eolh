<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class Login extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     *
     * @test
     * @return void
     */
    public function user_can_view_login_page(): void
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /**
     *
     * @test
     * @return void
     */
    public function user_cannot_view_login_page_when_authenticated(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->get('/login')
            ->assertRedirect('/home');
    }

    /**
     *
     * @test
     * @return void
     */
    public function user_can_login(): void
    {
        $password = Hash::make('password');
        $user = factory(User::class)->create(compact('password'));
        $this->from('login')->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ])->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /**
     *
     * @test
     * @return void
     */
    public function user_cannot_login_with_incorrect_credentials(): void
    {
        $user = factory(User::class)->create();
        $response = $this->from('/login')
            ->post('login', [
                'email' => $user->email,
                'password' => 'incorrect-password'
            ])->assertRedirect('/login');
        $this->assertTrue(session()->get('errors')->has('email'));
        
    }
}
