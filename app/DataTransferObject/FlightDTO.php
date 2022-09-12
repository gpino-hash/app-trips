<?php

namespace App\DataTransferObject;

use Spatie\LaravelData\Data;

class FlightDTO extends Data
{
    public function __construct(
        public readonly int $occupants,
        public string $departure_airport,
        public string $arrival_airport,
        public readonly string $check_in,
        public readonly string $check_out,
        public readonly string $type,
    )
    {
    }
}
