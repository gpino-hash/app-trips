<?php

namespace App\UseCase\Flight;

use App\DataTransferObject\FlightDTO;

interface IScale
{
    /**
     * @param FlightDTO $dto
     * @return array
     */
    public function filter(FlightDTO $dto): array;
}
