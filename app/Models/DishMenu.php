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
        return $this->belongsTo(Dish::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
