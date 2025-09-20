<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'is_premium'
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
