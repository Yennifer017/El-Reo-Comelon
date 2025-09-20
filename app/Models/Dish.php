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

    public function menu(){
        return $this->hasOne(Menu::class);
    }

    public function requiredFood(){
        return $this->hasMany(RequiredFood::class);
    }
    
}
