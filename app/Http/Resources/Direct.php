<?php

namespace App\Http\Resources;

use App\UseCase\ClassType;
use App\UseCase\TypeFlight;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Direct extends AbstractFlight
{

    /**
     * @param Collection $items
     * @param $request
     * @return array
     */
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
                ClassType::from($request->input("type")),
                false,
                false
            ),
            "type" => TypeFlight::UNSCALED,
            "flights" => $this->flights($items,
                $people,
                $checkIn,
                ClassType::from($request->input("type")),
                false,
                true)
        ];
    }
}
