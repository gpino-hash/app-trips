<?php

namespace App\UseCase;

trait Percentage
{
    /**
     * @param int $value1
     * @param int $value2
     * @return float
     */
    private function getPercentage(int $value1, int $value2): float
    {
        return $value1 * $value2 / 100;
    }
}
