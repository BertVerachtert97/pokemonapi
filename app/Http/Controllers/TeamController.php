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

    public function getTeams()
    {
        $teams = $this->teamService->getTeams();

        if (empty($teams)) {
            return new Response(json_encode('No teams found'), 200);
        }

        return  new Response(json_encode($teams), 200);
    }

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
}
