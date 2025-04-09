<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;

class Shop extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'logo',
        'website',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
