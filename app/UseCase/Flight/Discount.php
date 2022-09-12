<?php

namespace App\UseCase\Flight;

use App\UseCase\Percentage;

class Discount implements IDiscount
{
    use Percentage;

    public function apply(bool $hasScale, float $price): float
    {
        return number_format($hasScale
            ? $price - $this->getPercentage($price, self::DISCOUNT)
            : $price,2);
    }
}
