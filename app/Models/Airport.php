<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = ["name", "iata_code", "location", "country", "lat", "lon"];

    /**
     * @param $query
     * @param string $code
     * @return mixed
     */
    public function scopeJourney($query, string $code): mixed
    {
        return empty($code) ? $query : $query->where("iata_code", $code);
    }
}
