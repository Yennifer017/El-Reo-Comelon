<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Food;

class DishController extends Controller
{
    public function list(){
        $dishes = Dish::all();
        return view(
            'dishes.list',
            compact('dishes')
        );
    }

    public function showCreateView(){
        $foods = Food::all();
        return view(
            'dishes.create',
            compact('foods')
        );  
    }

    public function destroy($id)
    {
        $food = Dish::findOrFail($id);
        $food->delete();

        return redirect()->back()->with('success', 'Alimento eliminado correctamente.');
    }

    
}
