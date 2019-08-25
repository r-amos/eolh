<?php

namespace Tests\Feature\Activities;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;

class AddActivityTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     *
     * @return string
     */
    protected function getCreateActivityName(): string
    {
        return route('activities.create');
    }

    /**
     *
     * @return string
     */
    protected function getAddActivityName(): string
    {
        return route('activities.store');
    }

    /**
     *
     * @param integer $id
     * @return string
     */
    protected function getActivityName(int $id): string
    {
        return route('activities.show', $id);
    }

    /**
     * 
     * @test
     * @return void
     */
    public function user_can_view_add_activity_form(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get($this->getCreateActivityName())
            ->assertOk()
            ->assertViewIs('activities.create');
    }

    /**
     *
     * @test
     * @return void
     */
    public function guest_cannot_view_add_activity_form(): void
    {
        $this->get($this->getCreateActivityName())
            ->assertRedirect(route('login'));
    }

    /**
     * 
     * @test
     * @return void
     */
    public function user_can_add_a_activity(): void
    {

        $this->withExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post = factory(Activity::class)->make()->toArray();

        $response = $this->post($this->getAddActivityName(), $post);

        $this->assertCount(1, Activity::all());
        $this->assertDatabaseHas('activities', [
            'title' => $post['title'],
            'description' => $post['description']
        ]);
        $activity = Activity::first();
        $response->assertRedirect($this->getActivityName($activity->getkey()));
    }
}
