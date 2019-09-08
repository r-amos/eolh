<?php

namespace App\Actions\Activity;

use App\Activity;
use App\User;
use App\ActivityProperties;

class CreateActivity
{

    /**
     *
     * @param User $user
     * @param ActivityProperties $properties
     * @return Activity
     */
    public function execute(User $user, ActivityProperties $properties): Activity
    {
        return $user->activities()
            ->make($properties->getActivityProperties())
            ->createActivityType()
            ->createRoute($properties->getRouteProperties());
    }
}
