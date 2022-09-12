<?php

namespace App\Models;

use App\Models\Builder\FlightBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "departure_airport_id",
        "departure_date",
        "arrival_airport_id",
        "arrival_date",
        "airplane_id",
        "duration",
        "base_price",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(Airport::class, "departure_airport_id");
    }

    /**
     * @return BelongsTo
     */
    public function destiny(): BelongsTo
    {
        return $this->belongsTo(Airport::class, "arrival_airport_id");
    }

    /**
     * @return BelongsTo
     */
    public function airplane(): BelongsTo
    {
        return $this->belongsTo(Airplane::class);
    }

    /**
     * @param $query
     * @return FlightBuilder
     */
    public function newEloquentBuilder($query): FlightBuilder
    {
        return new FlightBuilder($query);
    }

    /**
     * @return Builder|FlightBuilder
     */
    public static function query(): Builder|FlightBuilder
    {
        return parent::query();
    }

    /**
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeCheckIn($query, $date): mixed
    {
        return empty($date) ? $query : $query->whereDate("departure_date", ">=", $date);
    }

    /**
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeCheckOut($query, $date): mixed
    {
        return empty($date) ? $query : $query->whereDate("departure_date", "<=", $date);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAvailableFlights($query): mixed
    {
        return $query->where("status", "scheduled")
                ->orWhere("status", "flying");
    }
}
