<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function trips(): BelongsToMany
    {
        return $this->belongsToMany(Trip::class, 'media_trip')->withTimestamps();
    }

    public function getPath(): string
    {
        return asset('storage/' . $this->path);
    }
}