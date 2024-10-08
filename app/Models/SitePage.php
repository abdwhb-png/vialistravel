<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitePage extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public static function booted(): void
    {
        static::creating(function ($item) {
            $pre = $item->menu_section ?? 'more';
            $item->permalink = '/' . $pre . '/' . Str::slug($item->name);
        });

        static::updating(function ($item) {
            $item->permalink = '/' . $item->menu_section . '/' . Str::slug($item->name);
        });
    }
}
