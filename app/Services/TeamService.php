<?php

namespace App\Services;

use App\Models\Team;

class TeamService
{
    /**
     * Get all teams
     *
     * @return array
     */
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

    /**
     * Get team by id
     *
     * @param $teamId
     *
     * @return array
     */
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

    /**
     * Create a team by name
     *
     * @param $name
     *
     * @return array
     */
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

    /**
     * Add pokemons to a team
     *
     * @param $pokemons
     * @param $teamId
     *
     * @return array
     */
    public function addPokemonsToTeam($pokemons, $teamId) {
        /** @var Team $team */
        $team = Team::find($teamId);

        $team->pokemons()->sync($pokemons);

        return [
            'id' => $teamId,
            'name' => $team->name,
            'pokemons' => $pokemons,
        ];
    }
}
