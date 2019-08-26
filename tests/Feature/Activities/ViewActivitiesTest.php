<?php

namespace Tests\Feature\Activities;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;

class ViewActivities extends TestCase
{
    use RefreshDatabase;

    /**
     * @param integer $id
     * @return string
     */
    protected function getActivitiesRoute(int $id): string
    {
        return route('activities.show', $id);
    }

    /**
     * @test
     * @return void
     */
    public function can_view_run_activity(): void
    {
        $activity = factory(Activity::class)->states(['withUser','run'])->create();
        $this->get($this->getActivitiesRoute($activity->getKey()))
            ->assertOk()
            ->assertSee($activity->title)
            ->assertSee($activity->formatted_date)
            ->assertSee($activity->formatted_distance)
            ->assertSee($activity->formatted_elevation)
            ->assertSee($activity->formatted_duration)
            ->assertSee($activity->description);
    }
}
