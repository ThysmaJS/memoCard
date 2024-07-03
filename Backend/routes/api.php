<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{category}/themes', [ThemeController::class, 'index']);
    Route::resource('themes', ThemeController::class)->except(['index']);
    Route::get('/themes', [ThemeController::class, 'allThemes']); // Ajoutez cette ligne
    Route::get('/themes/{theme}/cards', [CardController::class, 'index']); // Ajoutez cette ligne pour récupérer les cartes d'un thème spécifique
    Route::post('/cards/batch', [CardController::class, 'storeBatch']);
    Route::resource('cards', CardController::class)->except(['store']);
});
