<?php

namespace App\UseCase\Flight;

use App\UseCase\ClassType;
use App\UseCase\Percentage;

class CalculatePrice implements ICalculatePrice
{
    use Percentage;

    /**
     * @param ICalculateFirstClass $calculateFirstClass
     * @param IDiscount $discount
     */
    public function __construct(
        private readonly ICalculateFirstClass $calculateFirstClass,
        private readonly IDiscount $discount
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function apply(int    $people,
                          float  $price,
                                 $checkIn,
                                 $checkOut,
                          ClassType $type,
                          bool   $scale,
                          bool   $isUnit): string
    {
        $day = $checkIn->diffInDays($checkOut);
        $calculatePrice = $price;
        if ($day === 0 || $day === 1) {
            $calculatePrice = $price + $this->getPercentage($price, self::FIRST_COST);
        } else if ($day > 1 && $day <= 7) {
            $calculatePrice = $price + $this->getPercentage($price, self::SECOND_COST);
        }

        $calculatePrice = $isUnit ? $calculatePrice : $people * $calculatePrice;

        return ClassType::ECONOMIC === $type
            ? $this->discount->apply($scale, $calculatePrice)
            : $this->calculateFirstClass->apply($type, $calculatePrice);
    }
}
