<?php

namespace App\Http\Resources;

use App\UseCase\Flight\ICalculatePrice;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Direct extends AbstractFlight
{

    public function build(Collection $items, $request): array
    {
        $price = [];
        $people = $request->input("occupants");
        $checkIn = Carbon::parse($request->input("check_in"));
        $checkOut = "";
        foreach ($items as $item) {
            $checkOut = Carbon::parse($item->departure_date);
            $price[] = $item->base_price;
        }

        return [
            "total_price" => $this->calculatePrice->apply(
                $people,
                min($price),
                $checkIn,
                $checkOut,
                $request->input("type"),
                false,
                false
            ),
            "type" => "Non-stop flight",
            "flights" => $this->flights($items, $people, $checkIn, $request->input("type"), false, true)
        ];
    }
}
