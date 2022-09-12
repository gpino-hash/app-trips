<?php

namespace App\UseCase\Flight;

use App\DataTransferObject\FlightDTO;
use App\Models\Distance;
use App\Models\Flight;
use App\UseCase\Distance\IDistance;
use Illuminate\Support\Collection;

class Scale implements IScale
{

    /**
     * @param IDistance $distance
     */
    public function __construct(private readonly IDistance $distance)
    {
    }

    /**
     * @inheritDoc
     */
    public function filter(FlightDTO $dto): array
    {
        $data = [];
        $flights = $this->getFlightsWithFirstScale($dto);
        foreach ($flights as $secondScale) {
            if ($dto->departure_airport !== $secondScale->source->iata_code) {
                $flightWithScale = Flight::query()->getFlight($dto, $secondScale->source->iata_code,  3, true);
                if (!empty($flightWithScale)) {
                    foreach ($flightWithScale as $firstScale) {
                        $distance1 = Distance::query()->getDistance($firstScale->source->iata_code, $firstScale->destiny->iata_code);
                        $distance2 = Distance::query()->getDistance($secondScale->source->iata_code, $secondScale->destiny->iata_code);
                        if ($this->distance->hasDistance($distance1, $distance2)) {
                            $data[] = [
                                $firstScale,
                                $secondScale,
                            ];
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * @param FlightDTO $data
     * @return Collection
     */
    private function getFlightsWithFirstScale(FlightDTO $data): Collection
    {
        return Flight::query()->getFlight($data, null,  3)
            ->whereNotIn("source.iata_code", [$data->departure_airport]);
    }
}
