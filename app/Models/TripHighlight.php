<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TripHighlight extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}