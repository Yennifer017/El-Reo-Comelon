<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name',
        'price',
        'url_image',
        'expires_at',
    ];

    public function requiredFood()
    {
        return $this->hasMany(RequiredFood::class);
    }
}
