<?php

namespace Tests\Feature\Routes;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Route;

class AddRouteTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     *
     * @return string
     */
    protected function getCreateRouteName(): string
    {
        return route('routes.create');
    }

    /**
     *
     * @return string
     */
    protected function getAddRouteName(): string
    {
        return route('routes.store');
    }

    /**
     *
     * @param integer $id
     * @return string
     */
    protected function getRouteName(int $id): string
    {
        return route('routes.show', $id);
    }

    /**
     * 
     * @test
     * @return void
     */
    public function user_can_view_add_route_form(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get($this->getCreateRouteName())
            ->assertOk()
            ->assertViewIs('routes.create');
    }

    /**
     *
     * @test
     * @return void
     */
    public function guest_cannot_view_add_route_form(): void
    {
        $this->get($this->getCreateRouteName())
            ->assertRedirect(route('login'));
    }

    /**
     * 
     * @test
     * @return void
     */
    public function user_can_add_a_route(): void
    {

        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post = factory(Route::class)->make()->toArray();

        $response = $this->post($this->getAddRouteName(), $post);

        $this->assertCount(1, Route::all());
        $this->assertDatabaseHas('routes', [
            'title' => $post['title'],
            'description' => $post['description']
        ]);
        $route = Route::first();
        $response->assertRedirect($this->getRouteName($route->getkey()));
    }
}
