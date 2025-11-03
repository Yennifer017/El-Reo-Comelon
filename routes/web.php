<?php

use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//food
Route::get('/alimentos', [FoodController::class, 'inicializeFoodsView'])
    ->name('food');
Route::post('/food', [FoodController::class, 'store'])
    ->name('food.store');
Route::put('/food/{id}', [FoodController::class, 'update'])
    ->name('food.update');
Route::delete('/food/{id}', [FoodController::class, 'destroy'])
    ->name('food.destroy');
