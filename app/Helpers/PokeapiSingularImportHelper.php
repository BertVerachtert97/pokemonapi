<?php

namespace App\Helpers;

use App\Models\Ability;
use App\Models\Move;
use App\Models\Pokemon;
use App\Models\Stat;
use App\Models\Type;

class PokeapiSingularImportHelper
{
    /**
     * Import a pokemon.
     *
     * @param $pokemon
     *
     * @return mixed
     */
    public function importPokemon($pokemon)
    {
        /** @var Pokemon $currentPokemon */
        $currentPokemon = Pokemon::firstOrNew([
            'name' => $pokemon['name']
        ]);

        $currentPokemon->height($pokemon['height']);
        $currentPokemon->base_experience($pokemon['base_experience']);

        $currentPokemon->moves()->sync($this->importMoves($pokemon['moves']));

        foreach ($currentPokemon['abilities'] as $ability) {
            $currentPokemon->abilities()->attach(
                $this->importAbility($ability['ability']),
                [
                    'slot' => $ability['slot']
                ]
            );
        }

        foreach ($currentPokemon['stats'] as $stat) {
            $currentPokemon->stats()->attach(
                $this->importStat($stat['stat']),
                [
                    'base_stat' => $stat['base_stat']
                ]
            );
        }

        foreach ($currentPokemon['types'] as $type) {
            $currentPokemon->types()->attach(
                $this->importType($type['type']),
                [
                    'slot' => $type['slot']
                ]
            );
        }

        $currentPokemon->save();

        return $currentPokemon->name;
    }

    private function importType($type)
    {
        $currentType = Type::firstOrNew([
            'name' => $type['name']
        ]);

        $currentType->url($type['url']);
        $currentType->save();

        return $currentType->id;
    }

    /**
     * Import each stat per pokemon.
     * Create a new stat if it doesn't exist.
     *
     * @param $stat
     *
     * @return mixed
     */
    private function importStat($stat)
    {
        $currentStat = Stat::firstOrNew([
            'name' => $stat['name']
        ]);

        $currentStat->url($stat['url']);
        $currentStat->save();

        return $currentStat->id;
    }

    /**
     * Import each ability per pokemon.
     * Create a new ability if it doesn't exist.
     *
     * @param $ability
     *
     * @return mixed
     */
    private function importAbility($ability)
    {
        $currentAbility = Ability::firstOrNew([
            'name' => $ability['name']
        ]);

        $currentAbility->url($ability['url']);
        $currentAbility->save();

        return $currentAbility->id;
    }

    /**
     * Import each moves per pokemon.
     * Create a new move if it doesn't exist.
     *
     * @param $moves
     *
     * @return array
     */
    private function importMoves($moves)
    {
        $pokemonMoves = [];

        foreach ($moves as $item) {
            $move = $item['move'];
            $currentMove = Move::firstOrNew([
               'name' => $move['name']
            ]);

            $currentMove->url($move['url']);

            $currentMove->save();
            $pokemonMoves[] = $currentMove->id;
        }

        return $pokemonMoves;
    }
}