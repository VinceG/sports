<?php
namespace App\Http\Controllers\Api;

use App\Models\Team;
use App\Http\Requests\TeamRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Team as TeamResource;

class TeamController extends Controller
{ 
    /**
     * Return a list of teams
     *
     */
    public function list()
    {
        return TeamResource::collection(Team::paginate());
    }

    /**
     * Return a one team
     *
     */
    public function view($id)
    {
        $team = Team::with('players')->find($id);

        abort_unless(!empty($team), 404, 'Team was not found');

        return new TeamResource($team);
    }

    /**
     * Create team
     *
     */
    public function create(TeamRequest $request)
    {
        $team = (new Team)->create($request->all());

        return new TeamResource($team);
    }

    /**
     * Update team
     *
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return new TeamResource($team);
    }
}