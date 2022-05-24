<?php

namespace App\Services;

use App\Models\Pokemon;
use App\Models\Type;

class PokemonService
{
    public function getPokemons($orderBy)
    {
        switch ($orderBy) {
            case 'name-asc':
                $pokemons = Pokemon::orderBy('name', 'asc')->get();
                break;
            case 'name-desc':
                $pokemons = Pokemon::orderBy('name', 'desc')->get();
                break;
            case 'id-asc':
                $pokemons = Pokemon::orderBy('id', 'asc')->get();
                break;
            case 'id-desc':
                $pokemons = Pokemon::orderBy('id', 'desc')->get();
                break;
            default:
                $pokemons = Pokemon::all();
                break;
        }

        $pokemonJson = [];
        /** @var Pokemon $pokemon */
        foreach ($pokemons as $pokemon) {
            $types = [];
            /** @var Type $type */
            foreach ($pokemon->types as $type) {
                $types[] = [
                    'type' => [
                        'name' => $type->name,
                    ],
                    'slot' => $type->pivot->slot,
                ];
            }
            $pokemonJson[] = [
                'id' => $pokemon->id,
                'name' => $pokemon->name,
                'types' => $types
            ];
        }

        return $pokemonJson;
    }
}
