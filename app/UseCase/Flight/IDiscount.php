<?php

namespace App\UseCase\Flight;

interface IDiscount
{
    const DISCOUNT = 40;

    public function apply(bool $hasScale, float $price): string;
}
