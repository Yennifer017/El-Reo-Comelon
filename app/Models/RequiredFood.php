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
        return $this->belongsTo(Dish::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
    
}
