<?php

namespace Tests\Feature\Routes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Route;

class CanViewRoute extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function can_view_route(): void
    {
        $this->withoutExceptionHandling();
        $route = factory(Route::class)->create();
        $this->get("/routes/" . $route->getKey())
            ->assertOk()
            ->assertSee($route->title)
            ->assertSee($route->formatted_date)
            ->assertSee($route->formatted_distance)
            ->assertSee($route->formatted_elevation)
            ->assertSee($route->formatted_duration)
            ->assertSee($route->description);
    }
}
