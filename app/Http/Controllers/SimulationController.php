<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class SimulationController extends Controller
{
    public function showSimulationView()
    {
        $standarMenus = Menu::where('is_premium', false)->get();
        $premiumMenus = Menu::where('is_premium', true)->get();
        return view(
            'simulation.definition',
            compact('standarMenus', 'premiumMenus')
        );
    }

    public function start(Request $request)
    {
        $validated = $request->validate([
            'duration' => 'required|integer|min:1',
            'total_prisoners' => 'required|integer|min:1',
            'standard_menu' => 'required|exists:menus,id',
            'premium_menu' => 'nullable|exists:menus,id',
            'premium_preference' => 'nullable|numeric|min:0|max:100',
            'main_storage' => 'required|numeric|min:1',
            'alt_storage' => 'nullable|numeric|min:1',
            'general_purchase_cost' => 'required|numeric|min:0',
            'perishable_purchase_cost' => 'required|numeric|min:0',
        ]);

        if (empty($validated['premium_menu'])) {
            $validated['premium_preference'] = 0;
        }

        $standardMenu = Menu::findOrFail($validated['standard_menu']);
        $premiumMenu = $validated['premium_menu']
            ? Menu::findOrFail($validated['premium_menu'])
            : null;

        $simulationData = [
            'duration' => (int) $validated['duration'],
            'total_prisoners' => (int) $validated['total_prisoners'],
            'standard_menu' => $standardMenu,
            'premium_menu' => $premiumMenu,
            'premium_preference' => (float) $validated['premium_preference'],
            'main_storage' => (float) $validated['main_storage'],
            'alt_storage' => (float) ($validated['alt_storage'] ?? (float) $validated['main_storage']),
            'general_purchase_cost' => (float) $validated['general_purchase_cost'],
            'perishable_purchase_cost' => (float) $validated['perishable_purchase_cost'],
        ];

        return view('simulations.run', compact('simulationData'));
    }


}
