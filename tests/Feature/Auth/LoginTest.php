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
     * @return string
     */
    protected function getLoginRoute(): string
    {
        return route('login');
    }

    /**
     *
     * @return string
     */
    protected function getHomeRoute(): string
    {
        return route('home');
    }

    /**
     *
     * @test
     * @return void
     */
    public function user_can_view_login_page(): void
    {
        $this->get($this->getLoginRoute())
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
            ->get($this->getLoginRoute())
            ->assertRedirect($this->getHomeRoute());
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
        $this->from($this->getLoginRoute())->post($this->getLoginRoute(), [
            'email' => $user->email,
            'password' => 'password'
        ])->assertRedirect($this->getHomeRoute());
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
        $response = $this->from($this->getLoginRoute())
            ->post('login', [
                'email' => $user->email,
                'password' => 'incorrect-password'
            ])->assertRedirect($this->getLoginRoute());
        $this->assertTrue(session()->get('errors')->has('email'));
        
    }
}
