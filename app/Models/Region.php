<?php

namespace App\Models;

use App\Concerns\HasSlug;
use Illuminate\Support\Str;
use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

class Region extends Model implements Sluggable
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

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    public function heroMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'hero');
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interest::class)->withTimestamps();
    }

    public function picMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'pic');
    }

    public function scopeMedias(): array
    {
        return [
            'hero' => $this->hero ? asset('storage/' . Media::find($this->hero)->path) : asset('images/no-region-hero.jpg'),
            'pic' => $this->pic ? asset('storage/' . Media::find($this->pic)->path) : asset('images/no-region-pic.jpeg'),
        ];
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function wildlives(): BelongsToMany
    {
        return $this->belongsToMany(Wildlife::class)->withTimestamps();
    }
}