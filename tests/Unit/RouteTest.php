<?php

namespace Tests\Unit;

use App\Route;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class RouteTest extends TestCase
{
    /**
     * @test
     * @dataProvider dateProvider
     */
    public function date_is_formatted($date, $expected): void
    {
        $route = factory(Route::class)->make(['date_time' => $date]);
        $this->assertEquals($route->formatted_date, $expected);
    }

    /**
     *
     * @return array
     */
    public function dateProvider(): array
    {
        return [
            1 => [Carbon::parse('1st Jan 99'), '1st January, 1999'],
        ];
    }


    /**
     * @test
     * @dataProvider durationProvider
     */
    public function duration_is_formatted($duration, $expected): void
    {
        $route = factory(Route::class)->make(['duration' => $duration]);
        $this->assertEquals($route->formatted_duration, $expected);
    }

    /**
     *
     * @return array
     */
    public function durationProvider(): array
    {
        return [
            1 => [6,    "6 Seconds"],
            2 => [60,   "1 Minute"],
            3 => [122,  "2 Minutes and 2 Seconds"],
            4 => [6000, "1 Hour and 40 Minutes"],
            4 => [6005, "1 Hour 40 Minutes and 5 Seconds"],
        ];
    }
}
