<?php

namespace App\Helpers;

use App\Models\Ability;
use App\Models\Move;
use App\Models\Pokemon;
use App\Models\Sprite;
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

        $currentPokemon->height = $pokemon['height'];
        $currentPokemon->weight = $pokemon['weight'];
        $currentPokemon->order = $pokemon['order'];
        $currentPokemon->species = $pokemon['species']['name'];
        $currentPokemon->form = $pokemon['forms'][0]['name'];
        $currentPokemon->base_experience = $pokemon['base_experience'];

        $currentPokemon->save();

        $sprite = $this->importSprite($currentPokemon, $pokemon['sprites']);

        $currentPokemon->sprite()->save($sprite);

        $currentPokemon->moves()->sync($this->importMoves($pokemon['moves']));

        $currentPokemon->abilities()->detach();
        foreach ($pokemon['abilities'] as $ability) {
            $currentPokemon->abilities()->attach(
                $this->importAbility($ability['ability']),
                [
                    'slot' => $ability['slot'],
                    'is_hidden' => $ability['is_hidden'],
                ]
            );
        }

        $currentPokemon->stats()->detach();
        foreach ($pokemon['stats'] as $stat) {
            $currentPokemon->stats()->attach(
                $this->importStat($stat['stat']),
                [
                    'base_stat' => $stat['base_stat'],
                    'effort' => $stat['effort'],
                ]
            );
        }

        $currentPokemon->types()->detach();
        foreach ($pokemon['types'] as $type) {
            $currentPokemon->types()->attach(
                $this->importType($type['type']),
                [
                    'slot' => $type['slot']
                ]
            );
        }

        return $currentPokemon->name;
    }

    /**
     * Import a sprite per pokemon.
     * Create a new sprite if it doesn't exist.
     *
     * @param Pokemon $pokemon
     * @param $sprites
     *
     * @return mixed
     */
    private function importSprite($pokemon, $sprites)
    {
        $currentSprite = Sprite::firstOrNew([
            'pokemon_id' => $pokemon->id
        ]);

        foreach ($sprites as $key => $sprite) {
            if ($key === 'versions' || $key === 'other') {
                continue;
            }
            $currentSprite->$key = $sprite;
        }

        return $currentSprite;
    }

    /**
     * Import each type per pokemon.
     * Create a new type if it doesn't exist.
     *
     * @param $type
     *
     * @return mixed
     */
    private function importType($type)
    {
        $currentType = Type::firstOrNew([
            'name' => $type['name']
        ]);

        $currentType->url = $type['url'];
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

        $currentStat->url = $stat['url'];
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

        $currentAbility->url = $ability['url'];
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

            $currentMove->url = $move['url'];

            $currentMove->save();
            $pokemonMoves[] = $currentMove->id;
        }

        return $pokemonMoves;
    }
}
