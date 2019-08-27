<?php

namespace Tests\Feature\Activities;

use App\User;
use App\Route;
use App\Run;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
    public function user_can_add_a_activity_of_type_run(): void
    {
        
        // Set Up
        Storage::fake();
        $uploadedFile = UploadedFile::fake()->create('test.gpx');
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post = factory(Activity::class)->make()->toArray();

        // Post Data...
        $response = $this->post(
            $this->getAddActivityName(),
            array_merge($post, ['route' => $uploadedFile])
        );

        // Assert A Single Activity, Route & Run Have Been Created
        $activity = Activity::first();
        $this->assertCount(1, Activity::all());
        $this->assertCount(1, Route::all());
        $this->assertCount(1, Run::all());

        // Response Assertions
        $response->assertRedirect($this->getActivityName($activity->getKey()));


        // Assert Database Contains Activity, Route 
        $this->assertDatabaseHas('activities', [
            'title' => $post['title'],
            'description' => $post['description'],
            'typeable_id' => Run::first()->getKey(),
            'typeable_type' => Run::class
        ]);
        $this->assertDatabaseHas('routes', [
            'activity_id' => $activity->getKey()
        ]);

        // Assert Route File Uploaded To Storage
        Storage::assertExists(Route::first()->url);

        // Assert Correct Relationships Exist
        $this->assertInstanceOf(Run::class, $activity->typeable);
        $this->assertTrue($user->is($activity->user));
    }
}
