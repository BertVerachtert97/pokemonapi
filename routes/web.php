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

Route::get('/api/v1/search', [\App\Http\Controllers\PokemonController::class, 'getPokemonsBySearch']);

Route::get('/api/v2/pokemons', [\App\Http\Controllers\PokemonController::class, 'getPokemonsPaginated'])->name('pokemons.paginated');

Route::get('/api/v1/teams', [\App\Http\Controllers\TeamController::class, 'getTeams']);

Route::get('/api/v1/teams/{id}', [\App\Http\Controllers\TeamController::class, 'getTeamById']);

Route::post('/api/v1/teams', [\App\Http\Controllers\TeamController::class, 'createTeam']);

Route::post('/api/v1/teams/{id}', [\App\Http\Controllers\TeamController::class, 'addPokemonToTeam']);

\Aschmelyun\Larametrics\Larametrics::routes();
