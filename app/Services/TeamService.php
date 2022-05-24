<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    public function getTeams()
    {
        $teams = Team::all();

        $teamJson = [];
        /** @var Team $team */
        foreach ($teams as $team) {
            $pokemons = [];

            foreach ($team->pokemons as $pokemon) {
                $pokemons[] = $pokemon->name;
            }

            $teamJson[] = [
                'id' => $team->id,
                'name' => $team->name,
                'pokemons' => $pokemons
            ];
        }

        return $teamJson;
    }
}
