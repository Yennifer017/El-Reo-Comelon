<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//food2
Route::get('/food', [FoodController::class, 'inicializeFoodsView'])
    ->name('food');
Route::post('/food', [FoodController::class, 'store'])
    ->name('food.store');
Route::put('/food/{id}', [FoodController::class, 'update'])
    ->name('food.update');
Route::delete('/food/{id}', [FoodController::class, 'destroy'])
    ->name('food.destroy');

//dishes
Route::get('/dishes', [DishController::class, 'list'])
    ->name('dishes');
Route::delete('/dishes/{id}', [DishController::class, 'destroy'])
    ->name('dishes.destroy');
Route::get('dishes/create', [DishController::class, 'showCreateView'])
    ->name('dishes.create');
Route::post('dishes/create', [DishController::class, 'store'])
    ->name('dishes.store');
Route::get('/dishes/{id}', [DishController::class, 'show'])
    ->name('dishes.show');

//menus
Route::get('/menus', [MenuController::class, 'list'])
    ->name('menus');
Route::delete('/menus/{id}', [MenuController::class, 'delete'])
    ->name('menus.destroy');
Route::get('/menus/create', [MenuController::class, 'showCreateView'])
    ->name('menus.create');    
Route::post('/menus/create', [MenuController::class, 'store'])
    ->name('menus.store');
Route::get('/menus/{id}', [MenuController::class, 'show'])
    ->name('menus.show');