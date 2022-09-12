<?php

namespace App\Http\Resources;

use App\UseCase\ClassType;
use App\UseCase\Flight\ICalculatePrice;
use Carbon\Carbon;
use Illuminate\Support\Collection;

abstract class AbstractFlight
{
    public function __construct(
        protected ICalculatePrice $calculatePrice,
    )
    {
    }

    /**
     * @param array|Collection $items
     * @param int $people
     * @param string $checkIn
     * @param ClassType $type
     * @param bool $scale
     * @param bool $isUnit
     * @return array
     */
    protected function flights(
        array|Collection $items,
        int $people,
        string $checkIn,
        ClassType $type,
        bool $scale,
        bool $isUnit
    ): array
    {
        $response = [];
        foreach ($items as $item) {
            $response[] = [
                "airline" => $item->airplane->airline->name,
                "flight_number" => $item->code,
                "departure_airport" => $item->source->iata_code,
                "arrival_airport" => $item->destiny->iata_code,
                "departure_date" => $item->departure_date,
                "arrival_date" => $item->arrival_date,
                "price" => $this->calculatePrice->apply(
                    $people,
                    $item->base_price,
                    Carbon::parse($checkIn),
                    Carbon::parse($item->departure_date),
                    $type,
                    $scale,
                    $isUnit
                ),
                "type" => $type->value
            ];
        }

        return $response;
    }
}
