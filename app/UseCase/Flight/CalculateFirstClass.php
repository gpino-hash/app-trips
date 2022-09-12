<?php

namespace App\UseCase\Flight;

use App\UseCase\ClassType;
use App\UseCase\Percentage;

class CalculateFirstClass implements ICalculateFirstClass
{
    use Percentage;

    /**
     * @inheritDoc
     */
    public function apply(ClassType $type, float $price): string
    {
        return number_format(ClassType::ECONOMIC === $type
            ? $price
            : $price + $this->getPercentage($price, self::FIRST_CLASS), 2);
    }
}
