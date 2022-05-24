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

    public function getTeamById($teamId)
    {
        $team = Team::find($teamId);

        if (empty($team)) {
            return [];
        }

        $pokemons = [];

        foreach ($team->pokemons as $pokemon) {
            $pokemons[] = $pokemon->name;
        }

        return [
            'id' => $team->id,
            'name' => $team->name,
            'pokemons' => $pokemons
        ];
    }

    public function createTeam($name)
    {
        $team = Team::firstOrNew([
           'name' => $name
        ]);

        $team->save();

        $pokemons = [];

        if (!empty($team->pokemons)) {
            foreach ($team->pokemons as $pokemon) {
                $pokemons[] = $pokemon->name;
            }
        }

        return [
            'id' => $team->id,
            'name' => $team->name,
            'pokemons' => $pokemons
        ];
    }
}
