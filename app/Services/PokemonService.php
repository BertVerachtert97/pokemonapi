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
                'types' => $types,
            ];
        }

        return $pokemonJson;
    }

    public function getPokemonById($pokemonId)
    {
        /** @var Pokemon $pokemon */
        $pokemon = Pokemon::find($pokemonId);

        if (empty($pokemon)) {
            return [];
        }

        $types = [];
        foreach ($pokemon->types as $type) {
            $types[] = [
                'type' => $type->name,
                'slot' => $type->pivot->slot,
            ];
        }

        $moves = [];
        foreach ($pokemon->moves as $move) {
            $moves[] = [
                'move' => $move->name,
            ];
        }

        $stats = [];
        foreach ($pokemon->stats as $stat) {
            $stats[] = [
                'stat' => $stat->name,
                'base_stat' => $stat->pivot->base_stat,
                'effort' => $stat->pivot->effort,
            ];
        }

        $abilities = [];
        foreach ($pokemon->abilities as $ability) {
            $abilities[] = [
                'ability' => $ability->name,
                'is_hidden' => $ability->pivot->is_hidden === 1,
                'slot' => $ability->pivot->slot,
            ];
        }

        $sprite = [
            'front_default' => $pokemon->sprite->front_default,
            'front_female' => $pokemon->sprite->front_female,
            'front_shiny' => $pokemon->sprite->front_shiny,
            'front_shiny_female' => $pokemon->sprite->front_shiny_female,
            'black_default' => $pokemon->sprite->black_default,
            'black_female' =>$pokemon->sprite->black_female,
            'black_shiny' => $pokemon->sprite->black_shiny,
            'black_shiny_female' => $pokemon->sprite->black_shiny_defualt,
        ];

        return [
            'id' => $pokemon->id,
            'name' => $pokemon->name,
            'sprites' => $sprite,
            'types' => $types,
            'height' => $pokemon->height,
            'weight' => $pokemon->weight,
            'moves' => $moves,
            'order' => $pokemon->order,
            'species' => $pokemon->species,
            'stats' => $stats,
            'abilities' => $abilities,
            'form' => $pokemon->form,
        ];
    }
}
