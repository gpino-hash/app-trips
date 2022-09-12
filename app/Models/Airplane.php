<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airplane extends Model
{
    use HasFactory;

    protected $fillable = ["airline_id", "model", "economy_class_seats", "first_class_seats"];

    /**
     * @return BelongsTo
     */
    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * @return bool
     */
    public function scopeHasFirstClass(): bool
    {
        return $this->first_class_seats > 0;
    }
}
