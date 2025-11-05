<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishMenu;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{

    public function list()
    {
        $menus = Menu::all();
        return view(
            'menus.list',
            compact('menus')
        );
    }

    public function showCreateView()
    {
        $breakfasts = Dish::where('journey', 'BREAKFAST')->get();
        $lunchs = Dish::where('journey', 'LUNCH')->get();
        $dinners = Dish::where('journey', 'DINNER')->get();
        return view(
            'menus.create',
            compact('breakfasts', 'lunchs', 'dinners')
        );
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view(
            'menus.view',
            compact('menu')
        );
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        DishMenu::where('menu_id', $menu->id)->delete();
        $menu->delete();
        return redirect()->route('menus')
            ->with('success', 'Menú eliminado correctamente.');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_premium' => 'sometimes|boolean',
            'breakfast_dish_id' => 'required|exists:dishes,id',
            'lunch_dish_id' => 'required|exists:dishes,id',
            'dinner_dish_id' => 'required|exists:dishes,id'
        ]);

        $menu = Menu::create([
            'name' => $validated['name'],
            'is_premium' => $validated['is_premium'],
        ]);

        DishMenu::create([
            'dish_id' => $validated['breakfast_dish_id'],
            'menu_id' => $menu->id
        ]);

        DishMenu::create([
            'dish_id' => $validated['lunch_dish_id'],
            'menu_id' => $menu->id
        ]);

        DishMenu::create([
            'dish_id' => $validated['dinner_dish_id'],
            'menu_id' => $menu->id
        ]);

        return redirect()->route('menus')
            ->with('success', 'Menú creado correctamente.');
    }

}
