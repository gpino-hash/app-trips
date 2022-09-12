<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = ["name", "slug", "primary_color", "secondary_color"];

    /**
     * @return BelongsTo
     */
    public function airplane(): BelongsTo
    {
        return $this->belongsTo(Airplane::class);
    }
}
