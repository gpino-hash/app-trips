<?php

namespace App\UseCase\Distance;

use App\UseCase\Percentage;

class TotalDistance implements ITotalDistance
{
    use Percentage;

    /**
     * @inheritDoc
     */
    public function getTotalDistanceByScale(int $distance): int
    {
        return intval($this->getPercentage($distance, self::DISTANCE)) + $distance;
    }
}
