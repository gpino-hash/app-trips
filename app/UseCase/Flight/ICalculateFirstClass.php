<?php

namespace App\UseCase\Flight;

interface ICalculateFirstClass
{
    const FIRST_CLASS = 40;

    public function apply(string $type, float $price): float;
}
