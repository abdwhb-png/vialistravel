<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LegalPage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function booted(): void
    {
        static::creating(function ($item) {
            if (!$item->permalink) $item->permalink = '/legal/' . Str::slug($item->name);
        });

        static::updating(function ($item) {
            $item->permalink = '/legal/' . Str::slug($item->name);
        });
    }
}
