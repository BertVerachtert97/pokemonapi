<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{

    public function __construct(protected TeamService $teamService)
    {
    }

    /**
     * Get all the teams
     *
     * @return Response
     */
    public function getTeams()
    {
        $teams = $this->teamService->getTeams();

        if (empty($teams)) {
            return new Response(json_encode('No teams found'), 200);
        }

        return  new Response(json_encode($teams), 200);
    }

    /**
     * Get a team by id
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getTeamById(Request $request)
    {
        $teamId = $request->id;

        $team = $this->teamService->getTeamById($teamId);

        if (empty($team)) {
            return new Response(json_encode([
                'error' => 'Not found',
                'error_message' => 'Cannot find team with id: ' . $teamId
            ]), 404);
        }

        return new Response(json_encode($team), 200);
    }

    /**
     * Create a team by name
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createTeam(Request $request)
    {
        if (empty($request->all())) {
            return new Response(json_encode([
                'error' => 'Missing name',
                'error_message' => 'Missing name in the body'
            ]), 404);
        }

        $requestArray = $request->all();

        $team = $this->teamService->createTeam($requestArray['name']);

        return new Response(json_encode($team), 201);
    }

    /**
     * Add pokemons to a team
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|void
     */
    public function addPokemonToTeam(Request $request) {
        if (empty($request->id)) {
            return new Response(json_encode([
                'error' => 'Missing id',
                'error_message' => 'Missing id of the team'
            ]), 404);
        }

        if (empty($request->all())) {
            return new Response(json_encode([
                'error' => 'Missing pokemons',
                'error_message' => 'Missing pokemons in the body'
            ]), 404);
        }

        $teamId = $request->id;
        $requestArray = $request->all();

        $team = $this->teamService->addPokemonsToTeam($requestArray['pokemons'], $teamId);

        return new Response(json_encode($team), 200);
    }
}
