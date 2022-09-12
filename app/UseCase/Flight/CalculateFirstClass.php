<?php

namespace App\UseCase\Flight;

use App\UseCase\Percentage;

class CalculateFirstClass implements ICalculateFirstClass
{
    use Percentage;

    public function apply(string $type, float $price): float
    {
        return $type === "economic" ? $price : $price + $this->getPercentage($price, self::FIRST_CLASS);
    }
}
