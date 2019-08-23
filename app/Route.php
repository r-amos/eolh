<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * Model Attributes
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'date_time',
        'distance',
        'duration',
        'elevation',
        'description'
    ];

    protected $dates = [
        'date_time'
    ];

    /**
     * Get The Route Date
     *
     * @return string
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date_time->format("F jS, Y");
    }

    /**
     * Get The Distance of the Route
     *
     * @return string
     */
    public function getFormattedDistanceAttribute(): string
    {
        return number_format($this->distance / 1.6, 2) . " miles";
    }

    /**
     * Get The Formatted Duration
     *
     * @return string
     */
    public function getFormattedElevationAttribute(): string
    {
        return number_format($this->elevation) . " feet";
    }

    /**
     * Return Formatted Duration
     *
     * @return string
     */
    public function getFormattedDurationAttribute(): string
    {
        $hours   = floor($this->duration / 3600);
        $minutes = floor($this->duraton / 60) % 60;
        $seconds = $this->duration % 60;

        return "$hours hours, $minutes minutes and $seconds seconds";
    }
}
