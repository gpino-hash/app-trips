<?php

namespace App\UseCase\Flight;

use App\DataTransferObject\FlightDTO;

interface IScale
{
    public function filter(FlightDTO $dto): array;
}
