<?php

namespace App\Models;

use App\Concerns\HasSlug;
use Illuminate\Support\Str;
use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Interest extends Model implements Sluggable
{
    use HasFactory,
        DefaultOrderBy,
        HasSlug;

    protected $guarded = ['id'];

    protected static $orderByColumn = 'title';

    public function slugAttribute(): string
    {
        return 'title';
    }

    public function scopeShowUrl(): string
    {
        return route(session('route_prefix') . 'showData', ['type' => 'interest', 'id' => $this->id]);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class)->orderBy('title')->withTimestamps();
    }
}