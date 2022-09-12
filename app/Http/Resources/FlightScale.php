<?php

namespace App\Http\Resources;

use App\UseCase\ClassType;
use App\UseCase\TypeFlight;
use Carbon\Carbon;

class FlightScale extends AbstractFlight
{

    /**
     * @param array $flights
     * @param $request
     * @return array
     */
    public function build(array $flights, $request): array
    {
        $people = $request->input("occupants");
        $checkIn = Carbon::parse($request->input("check_in"));
        $checkOut = "";
        $items = [];

        foreach ($flights as $flight) {
            foreach ($flight as $item) {
                $items[] = $item;
                $checkOut = Carbon::parse($item->departure_date);
            }
        }

        return [
            "total_price" => $this->calculatePrice->apply(
                $people,
                min($this->sumPricePerScale($items)),
                $checkIn,
                $checkOut,
                ClassType::from($request->input("type")),
                true,
                false
            ),
            "type" => TypeFlight::WITH_SCALE,
            "flights" => $this->flights($items,
                $people,
                $checkIn,
                ClassType::from($request->input("type")),
                true,
                true)
        ];
    }

    /**
     * @param array $flights
     * @return array
     */
    private function sumPricePerScale(array $flights): array
    {
        $priceTotal = [];

        $flights = array_chunk($flights, 2);

        foreach ($flights as $flight) {
            $price = 0;
            foreach ($flight as $item) {
                $price += $item->base_price;
            }
            $priceTotal[] = $price;
        }

        return $priceTotal;
    }
}
