<?php

namespace App\UseCase\Distance;

interface ITotalDistance
{
    const DISTANCE = 30;

    /**
     * @param int $distance
     * @return int
     */
    public function getTotalDistanceByScale(int $distance): int;
}
