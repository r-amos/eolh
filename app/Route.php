<?php

namespace App;

use App\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Route extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];
}
