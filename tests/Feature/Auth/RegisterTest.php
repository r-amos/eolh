<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class Register extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     *
     * @return string
     */
    protected function getRegisterRoute(): string
    {
        return route('register');
    }

    /**
     *
     * @return string
     */
    public function getPostRegisterRoute(): string
    {
        return route('home');
    }

    /**
     * @test
     * @return void
     */
    public function guest_can_view_registration_form(): void
    {
        $response = $this->get($this->getRegisterRoute());
        $response->assertStatus(200);
    }

    /**
     * 
     * @test
     * @return void
     */
    public function user_logged_in_cannot_view_registration(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)->get($this->getRegisterRoute())
            ->assertRedirect($this->getPostRegisterRoute());
    }

    /**
     * @test
     * @return void
     */
    public function guest_can_register(): void
    {

        $guest = factory(User::class)->make();

        $response = $this->post($this->getRegisterRoute(), [
            'email' => $guest->email,
            'name' => $guest->name,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect($this->getPostRegisterRoute());
        $this->assertCount(1, User::all());
        $this->assertAuthenticatedAs($user = User::first());
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'name' => $user->name
        ]);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     * @test
     * @return void
     */
    public function guest_cannot_register_again(): void
    {
        $guest = factory(User::class)->create();

        $response = $this->from($this->getRegisterRoute())
            ->post($this->getRegisterRoute(), [
                'email' => $guest->email,
                'name' => $guest->name,
                'password' => 'password',
                'password_confirmation' => 'password'
            ]);

        $response->assertRedirect($this->getRegisterRoute());
        $this->assertCount(1, User::all());
    }

    /**
     * @test
     * @return void
     * @param string $field
     * @param string $errorField
     * @dataProvider guestProvider
     */
    public function guest_cannot_register_without_required_data(string $field, string $errorField = null): void
    {
        $payload = array_filter([
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => 'password',
            'password_confirmation' => 'password'
        ], function ($key) use ($field) {
            return $key !== $field;
        }, ARRAY_FILTER_USE_KEY);

        $this->from($this->getRegisterRoute())
            ->post($this->getRegisterRoute(), $payload)
            ->assertRedirect($this->getRegisterRoute());

        $this->assertCount(0, User::all());
        $this->assertTrue(session()->get('errors')->has($errorField ?: $field));
    }

    /**
     *
     * @return array
     */
    public function guestProvider(): array
    {
        return [
            'name'                  => ['name'],
            'email'                 => ['email'],
            'password'              => ['password'],
            'password confirmation' => ['password_confirmation', 'password']
        ];
    }

    /**
     * @test
     * @return void
     */
    public function guest_cannot_register_without_matching_passwords(): void
    {
        $this->from($this->getRegisterRoute())->post($this->getRegisterRoute(), [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => 'password',
            'password_confirmation' => 'does not match'

        ])->assertRedirect($this->getRegisterRoute())
            ->assertSessionHasErrors(['password']);
    }
}
