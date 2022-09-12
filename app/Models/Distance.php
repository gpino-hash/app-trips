<?php

namespace App\Models;

use App\Models\Builder\DistanceBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    use HasFactory;

    protected $fillable = ["airport_1", "airport_2", "kilometers"];

    /**
     * @param $query
     * @return DistanceBuilder
     */
    public function newEloquentBuilder($query): DistanceBuilder
    {
        return new DistanceBuilder($query);
    }

    /**
     * @return Builder|DistanceBuilder
     */
    public static function query(): Builder|DistanceBuilder
    {
        return parent::query();
    }
}
