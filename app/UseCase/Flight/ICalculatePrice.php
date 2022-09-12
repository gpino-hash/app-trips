<?php

namespace App\UseCase\Flight;

use App\UseCase\ClassType;

interface ICalculatePrice
{
    const FIRST_COST = 35;

    const SECOND_COST = 20;

    /**
     * @param int $people
     * @param float $price
     * @param $checkIn
     * @param $checkOut
     * @param ClassType $type
     * @param bool $scale
     * @param bool $isUnit
     * @return string
     */
    public function apply(int    $people,
                          float  $price,
                                 $checkIn,
                                 $checkOut,
                          ClassType $type,
                          bool   $scale,
                          bool   $isUnit): string;
}
