<?php

namespace App\UseCase\Flight;

use App\UseCase\Percentage;

class CalculatePrice implements ICalculatePrice
{
    use Percentage;

    public function __construct(
        private readonly ICalculateFirstClass $calculateFirstClass,
        private readonly IDiscount $discount
    )
    {
    }

    public function apply(int $people, float $price, $checkIn, $checkOut, string $type, bool $scale, bool $isUnit): float
    {
        return $this->calculatePerDay($people, $price, $checkIn, $checkOut, $type, $scale, $isUnit);
    }

    private function calculatePerDay(
        int $people,
        float $price,
        $checkIn,
        $checkOut,
        string $type,
        bool $scale,
        bool $isUnit
    ): float|int
    {
        $day = $checkIn->diffInDays($checkOut);
        $calculatePrice = $price;
        if ($day === 0 || $day === 1) {
            $calculatePrice = $price + $this->getPercentage($price, self::FIRST_COST);
        } else if ($day > 1 && $day <= 7) {
            $calculatePrice = $price + $this->getPercentage($price, self::SECOND_COST);
        }

        $calculatePrice = $isUnit ? $calculatePrice : $people * $calculatePrice;

        return $type === "economic"
            ? $this->discount->apply($scale, $calculatePrice)
            : $this->calculateFirstClass->apply($type, $calculatePrice);
    }
}
