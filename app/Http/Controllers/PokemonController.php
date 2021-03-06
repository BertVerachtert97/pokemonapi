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

    /**
     * Get all the pokemons
     *
     * @param Request $request
     *
     * @return Response
     */
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

    /**
     * Get a pokemon by id
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getPokemonById(Request $request)
    {
        $pokemonId = $request->id;

        $pokemon = $this->pokemonService->getPokemonById($pokemonId);

        if (empty($pokemon)) {
            return new Response(json_encode([
                'error' => 'Not found',
                'error_message' => 'Cannot find pokemon with id: ' . $pokemonId
            ]), 404);
        }

        return new Response(json_encode($pokemon), 200);
    }

    /**
     * Get pokemons by search
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getPokemonsBySearch(Request $request)
    {
        $query = $request->get('query');
        $limit = '';

        if ($request->exists('limit')) {
            $limit = $request->get('limit');
        }

        $pokemons = $this->pokemonService->getPokemonsByQuery($query, $limit);

        if (empty($pokemons)) {
            return new Response(json_encode('No pokemons found'), 200);
        }

        return new Response(json_encode($pokemons), 200);
    }

    /**
     * Get all pokemons paginated
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getPokemonsPaginated(Request $request)
    {
        $orderBy = '';
        if ($request->exists('sort')) {
            $orderBy = $request->get('sort');
        }

        $limit = 10;
        if ($request->exists('limit')) {
            $limit = $request->get('limit');
        }

        $pokemons = $this->pokemonService->getPokemonsPaginated($orderBy, $limit);

        if (empty($pokemons)) {
            return new Response(json_encode('No pokemons found'), 200);
        }

        return new Response(json_encode($pokemons), 200);
    }
}
