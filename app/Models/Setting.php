<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function siteLogo(): Attribute
    {
        return Attribute::make(
            get: fn(string|null $value) => $value ? asset('storage/' . Media::find($value)->path) : asset('images/no-image.webp'),
        );
    }
}