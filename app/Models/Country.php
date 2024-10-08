<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Contracts\Sluggable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Country extends Model implements Sluggable
{
    use HasFactory,
        DefaultOrderBy,
        HasSlug,
        SoftDeletes;

    protected $guarded = ['id'];

    protected static $orderByColumn = 'title';

    public function slugAttribute(): string
    {
        return 'title';
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function showUrl(): string
    {
        return route(session('route_prefix') . 'showData', ['type' => 'country', 'id' => $this->id]);
    }
}
