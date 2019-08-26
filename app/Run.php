<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Activity;

class Run extends Model
{
    /**
     *
     * @return void
     */
    public function activity(): MorphOne
    {
        return $this->morphOne(Activity::class, 'typeable');
    }
}
