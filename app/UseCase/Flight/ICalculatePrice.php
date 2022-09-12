<?php

namespace App\UseCase\Flight;

interface ICalculatePrice
{
    const FIRST_COST = 35;

    const SECOND_COST = 20;

    public function apply(int $people, float $price, $checkIn, $checkOut, string $type, bool $scale, bool $isUnit): float;
}
