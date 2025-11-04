<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequiredFood extends Model
{
    protected $fillable = [
        'dish_id',
        'food_id',
        'quantity'
    ];

    public function dish()
    {
        return $this->hasOne(Dish::class);
    }

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }
    
}
