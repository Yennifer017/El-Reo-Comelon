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
    ->name('food.destroy');

//menus
Route::get('/menus', [MenuController::class, 'list'])
    ->name('menus');
Route::get('/menus/{id}', [MenuController::class, 'show'])
    ->name('menus.show');