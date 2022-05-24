<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function __construct(protected PokemonService $pokemonService)
    {
    }

    public function getPokemons(Request $request)
    {
        $orderBy = '';
        if ($request->exists('sort')) {
            $orderBy = $request->get('sort');
        }

        $pokemons = $this->pokemonService->getPokemons($orderBy);

        if (empty($pokemons)) {
            return new Response(json_encode('No pokemons found'), 200);
        }

        return new Response(json_encode($pokemons), 200);
    }
}
