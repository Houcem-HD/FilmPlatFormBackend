<?php

use App\Http\Controllers\ActeurController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EditeurController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\RealisateursController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// crud User
Route::post('/login', [userController::class, 'login']); 
Route::middleware('auth:sanctum')->post('/logout', [userController::class, 'logout']);

Route::get('/user', [UserController::class, 'getUser']); 

Route::post('/adduser', [userController::class, 'store']); 
Route::get('/users', [userController::class, 'index']); 
Route::get('/users/{id}', [userController::class, 'show']); 
Route::put('/users/{id}', [userController::class, 'update']); 
Route::delete('/users/{id}', [userController::class, 'destroy']);

// crud categorie
Route::get('/categorie', [CategorieController::class, 'index']);
Route::post('/categorie', [CategorieController::class, 'store']);
Route::get('/categorie/{id}', [CategorieController::class, 'show']);
Route::put('/categorie/{id}', [CategorieController::class, 'update']);
Route::delete('/categorie/{id}', [CategorieController::class, 'destroy']);

// crud acteur
Route::get('/acteur', [ActeurController::class, 'index']);
Route::post('/acteur', [ActeurController::class, 'store']);
Route::get('/acteur/{id}', [ActeurController::class, 'show']);
Route::put('/acteur/{id}', [ActeurController::class, 'update']);
Route::delete('/acteur/{id}', [ActeurController::class, 'destroy']);

// crud editeur
Route::get('/editeur', [EditeurController::class, 'index']);
Route::post('/editeur', [EditeurController::class, 'store']);
Route::get('/editeur/{id}', [EditeurController::class, 'show']);
Route::put('/editeur/{id}', [EditeurController::class, 'update']);
Route::delete('/editeur/{id}', [EditeurController::class, 'destroy']);

// crud langue
Route::get('/langue', [LangueController::class, 'index']);
Route::post('/langue', [LangueController::class, 'store']);
Route::get('/langue/{id}', [LangueController::class, 'show']);
Route::put('/langue/{id}', [LangueController::class, 'update']);
Route::delete('/langue/{id}', [LangueController::class, 'destroy']);

// crud film
Route::get('/film', [FilmController::class, 'index']);
Route::post('/film', [FilmController::class, 'store']);
Route::get('/film/{id}', [FilmController::class, 'show']);
Route::put('/film/{id}', [FilmController::class, 'update']);
Route::delete('/film/{id}', [FilmController::class, 'destroy']);

// crud realisateur
Route::get('/realisateur', [RealisateursController::class, 'index']);
Route::post('/realisateur', [RealisateursController::class, 'store']);
Route::get('/realisateur/{id}', [RealisateursController::class, 'show']);
Route::put('/realisateur/{id}', [RealisateursController::class, 'update']);
Route::delete('/realisateur/{id}', [RealisateursController::class, 'destroy']);