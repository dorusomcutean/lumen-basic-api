<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayersController extends Controller
{

    /** @var Player */
    protected $player;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Return all the players
     */
    public function index() {
       
        $players = $this->player->all();

        return $players;
    }

    /**
     * Return a specific player
     */
    public function show($playerId) {
        
        $player = $this->player->find($playerId);

        if (empty($player)) {
               return "No data found.";
        }
       
        return $player;
    }
    
    /**
     * Create a new player
     */
    public function store(Request $request) {
        
        // Validate if the input for each field is correct 
        $this->validate($request, [
            'name' => 'required|string',
            'age' => 'required|integer',
            'nationality' => 'required|string',
            'club' => 'required|string',
            'gender' => 'required|string',
           ]);

        // Create the player
        $player = $this->player->create([
            'name' => $request->input('name'),
            'age' =>  $request->input('age'),
            'nationality' =>  $request->input('nationality'),
            'club' =>  $request->input('club'),
            'gender' =>  $request->input('gender'),
        ]);

        return $player;
    }

    /**
     * Update info for a specific player
     */
    public function update(Request $request, $playerId) {
       
        // Validate if the input for each field is correct 
        $this->validate($request, [
            'name' => 'required|string',
            'age' => 'required|integer',
            'nationality' => 'required|string',
            'club' => 'required|string',
            'gender' => 'required|string',
           ]);

        // Find the player you want to update
        $player = $this->player->find($playerId);

        // Return error if not found
        if (empty($player)) {
            return "No data found.";
        }

        // Update the player
        $player->update([
            'name' => $request->input('name'),
            'age' =>  $request->input('age'),
            'nationality' =>  $request->input('nationality'),
            'club' =>  $request->input('club'),
            'gender' =>  $request->input('gender'),
        ]);

        return $player;
    }

    /**
     * Delete a specific player
     */
    public function destroy($playerId) {
       
        $player = $this->player->find($playerId);

        if (empty($player)) {
            return "No data found.";
        }

        $player->delete();

        return;
    }
}
