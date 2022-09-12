<?php

namespace App\UseCase\Distance;

interface IDistance
{
    const MAX_DISTANCE = 5000;

    /**
     * @param int $distance1
     * @param int $distance2
     * @return bool
     */
    public function hasDistance(int $distance1, int $distance2): bool;
}
