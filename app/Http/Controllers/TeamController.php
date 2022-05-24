<?php

namespace App\Http\Controllers;

use App\Services\TeamService;
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
}
