<?php

namespace App\UseCase\Flight;

use App\UseCase\ClassType;

interface ICalculateFirstClass
{
    const FIRST_CLASS = 40;

    /**
     * @param ClassType $type
     * @param float $price
     * @return string
     */
    public function apply(ClassType $type, float $price): string;
}
