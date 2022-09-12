<?php

namespace App\UseCase\Distance;

class Distance implements IDistance
{

    /**
     * @inheritDoc
     */
    public function hasDistance(int $distance1, int $distance2): bool
    {
        return ($distance1 + $distance2) <= self::MAX_DISTANCE;
    }
}
