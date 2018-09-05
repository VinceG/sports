<?php
namespace App\Http\Controllers\Api;

use App\Models\Player;
use App\Http\Requests\PlayerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Player as PlayerResource;

class PlayerController extends Controller
{ 
    /**
     * Return a list of players
     *
     */
    public function list()
    {
        return PlayerResource::collection(Player::paginate());
    }

    /**
     * Return a one player
     *
     */
    public function view($id)
    {
        $player = Player::with('team')->find($id);

        abort_unless(!empty($player), 404, 'Player was not found');

        return new PlayerResource($player);
    }

    /**
     * Create player
     *
     */
    public function create(playerRequest $request)
    {
        $player = (new Player)->create($request->all());

        return new PlayerResource($player);
    }

    /**
     * Update player
     *
     */
    public function update(playerRequest $request, Player $player)
    {
        $player->update($request->all());

        return new PlayerResource($player);
    }
}