<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/v1/pokemons', [\App\Http\Controllers\PokemonController::class, 'getPokemons']);

Route::get('/api/v1/pokemons/{id}', [\App\Http\Controllers\PokemonController::class, 'getPokemonById']);

Route::get('/api/v1/teams', [\App\Http\Controllers\TeamController::class, 'getTeams']);
