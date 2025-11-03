<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    public function inicializeFoodsView(){
        $foods = Food::all();
        return view(
            'foods',
            compact('foods')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'space' => 'required|numeric',
            'url_image' => 'required|string',
            'expires_at' => 'required|integer',
        ]);

        Food::create($validated);

        return redirect()->back()->with('success', 'Alimento agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'space' => 'sometimes|numeric',
            'url_image' => 'sometimes|string',
            'expires_at' => 'sometimes|integer',
        ]);

        $food->update($validated);

        return redirect()->back()->with('success', 'Alimento editado correctamente.');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return redirect()->back()->with('success', 'Alimento eliminado correctamente.');
    }

}
