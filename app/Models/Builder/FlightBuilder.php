<?php

namespace App\Models\Builder;

use App\DataTransferObject\FlightDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FlightBuilder extends Builder
{

    public function getFlight(FlightDTO $flightDTO, $departure = null, int $nItems = 0, bool $isNotScale = false): Collection
    {
        $query = $this->with(["source", "destiny", "airplane.airline"])
            ->whereRelation("destiny", "iata_code", empty($departure) ? $flightDTO->arrival_airport : $departure);
        if ($isNotScale) {
            $query->whereRelation("source", "iata_code", $flightDTO->departure_airport);
        }
        return $query->checkIn($flightDTO->check_in)
        ->checkOut($flightDTO->check_out)
        ->availableFlights()
        ->orderBy("base_price", "ASC")
        ->limit($nItems)
        ->get();
    }
}
