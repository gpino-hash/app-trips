<?php
namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Builder;

class DistanceBuilder extends Builder
{
    /**
     * @param string $from
     * @param string $to
     * @return int
     */
    public function getDistance(string $from, string $to): int
    {
        $distance = $this->select("kilometers")
            ->where("airport_1", $from)
            ->where("airport_2", $to)
            ->first();

        return intval($distance->kilometers);
    }
}
