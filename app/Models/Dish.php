<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    //
    protected $fillable = [
        'name',
        'journey',
        'menu_id'
    ];

    public function dishMenus(){
        return $this->hasMany(DishMenu::class);
    }

    public function requiredFood(){
        return $this->hasMany(RequiredFood::class);
    }
    
}
