<?php

namespace App\Contracts;

interface ActivityProperties
{

    /**
     *
     * @return array
     */
    public function getActivityProperties(): array;

    /**
     *
     * @return array
     */
    public function getRouteProperies(): array;
}