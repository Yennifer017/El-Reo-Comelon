<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Food;
use App\Models\RequiredFood;

class DishController extends Controller
{
    public function list()
    {
        $dishes = Dish::all();
        return view(
            'dishes.list',
            compact('dishes')
        );
    }

    public function showCreateView()
    {
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'journey' => 'required|in:BREAKFAST,LUNCH,DINNER',
            'foods' => 'nullable|array',
            'foods.*.selected' => 'nullable|boolean',
            'foods.*.quantity' => 'nullable|numeric|min:0.01',
        ]);

        $dish = Dish::create([
            'name' => $validated['name'],
            'journey' => $validated['journey'],
        ]);

        if (!empty($validated['foods'])) {
            foreach ($validated['foods'] as $foodId => $foodData) {
                if (isset($foodData['selected']) && $foodData['selected'] == 1) {
                    RequiredFood::create([
                        'dish_id' => $dish->id,
                        'food_id' => $foodId,
                        'quantity' => $foodData['quantity'] ?? 1,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Platillo creado correctamente.');
        
    }

}
