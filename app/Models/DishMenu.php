<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishMenu extends Model
{
    protected $fillable = [
        'dish_id',
        'menu_id'
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
