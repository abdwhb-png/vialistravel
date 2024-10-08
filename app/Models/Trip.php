<?php

namespace App\Models;

use App\Concerns\HasSlug;
use Illuminate\Support\Str;
use App\Contracts\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model implements Sluggable
{
    use HasFactory,
        HasSlug;

    protected $guarded = ['id'];


    public function slugAttribute(): string
    {
        return 'title';
    }

    public static function booted(): void
    {
        static::created(function ($item) {
            TripOverview::create(['trip_id' => $item->id]);
        });
    }

    public function accomodations(): BelongsToMany
    {
        return $this->belongsToMany(Accomodation::class)->withTimestamps();
    }

    public function dates(): HasMany
    {
        return $this->hasMany(TripDate::class);
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    public function heroMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'hero');
    }

    public function highlights(): HasMany
    {
        return $this->hasMany(TripHighlight::class);
    }

    public function itinarary(): HasOne
    {
        return $this->hasOne(TripItinerary::class);
    }

    public function overview(): HasOne
    {
        return $this->hasOne(TripOverview::class);
    }

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'media_trip')->withTimestamps();
    }


    public function picMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'pic');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeIsAvailable(): bool
    {
        $now = now()->format('Y-m-d');
        foreach ($this->dates as $date) {
            if ($date->departure <= $now && $date->return >= $now)
                return true;
        }

        return false;
    }

    public function scopeMedias(): array
    {
        $hero = asset('images/no-trip-pic.jpg');
        if ($this->hero)
            $hero =  asset('storage/' . Media::find($this->hero)->path);
        else if ($this->region)
            $hero = $this->region->medias()['hero'];
        return [
            'hero' => $this->hero ? asset('storage/' . Media::find($this->hero)->path) : asset('images/no-trip-hero.jpg'),
            'pic' => $this->pic ? asset('storage/' . Media::find($this->pic)->path) : asset('images/no-trip-pic.jpg'),
        ];
    }

    public function scopeParsedPhotos(): array
    {
        $result = [];
        foreach ($this->photos as $k => $photo) {
            $result[] = [
                'media' => $photo,
                'src' => $photo->getPath(),
                'alt' => 'trip photo ' . $k + 1,
                'delete_route' => '/delete-trip-photo',
            ];
        }
        return $result;
    }
}