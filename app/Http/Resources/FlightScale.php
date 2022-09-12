<?php

namespace App\Http\Resources;

use Carbon\Carbon;

class FlightScale extends AbstractFlight
{

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
                $request->input("type"),
                true,
                false
            ),
            "type" => "Stopover flight",
            "flights" => $this->flights($items, $people, $checkIn, $request->input("type"), true, true)
        ];
    }

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
