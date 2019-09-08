<?php

namespace App;

use App\Support\SecondsToFormattedString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Route;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
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
     * Get The Activity Date
     *
     * @return null|string
     */
    public function getFormattedDateAttribute(): ?string
    {
        if ($this->date_time) {
            return $this->date_time->format("jS F, Y");
        }
        return null;
    }

    /**
     * Get The Distance of the Activity
     *
     * @return string
     */
    public function getFormattedDistanceAttribute(): ?string
    {
        if ($this->number_format) {
            return number_format($this->distance / 1.6, 2) . " miles";
        }
        return null;
    }

    /**
     * Get The Formatted Duration
     *
     * @return string
     */
    public function getFormattedElevationAttribute(): ?string
    {
        if ($this->elevation) {
            return number_format($this->elevation) . " feet";
        }
        return null;
    }

    /**
     * Return Formatted Duration
     *
     * @return string
     */
    public function getFormattedDurationAttribute(): ?string
    {
        if ($this->duration) {
            $secondsToString = resolve(SecondsToFormattedString::class);
            $secondsToString->setSeconds($this->duration);
            return $secondsToString->convert();
        }
        return null;
    }

    /**
     *
     * @param array $properties
     * @return Activity
     */
    public function createRoute(array $properties): Activity
    {
        $this->route()->create($properties);
        return $this;
    }

    /**
     *
     * @return Activity
     */
    public function createActivityType(): Activity
    {
        return Run::create()->activity()->save($this);
    }

    /**
     *
     * @return HasOne
     */
    public function route(): HasOne
    {
        return $this->hasOne(Route::class);
    }

    /**
     *
     * @return MorphTo
     */
    public function typeable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
