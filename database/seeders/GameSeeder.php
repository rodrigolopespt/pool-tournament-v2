<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Friend;
use Illuminate\Database\Seeder;
use App\Services\TournamentRulesService;

class GameSeeder extends Seeder
{
    public function run()
    {
        Game::factory(10)->create()->each(function($game){
            $duplicateCheck = true;
            while($duplicateCheck == true){
                $opponent = Friend::where('id','<>',$game->winner_id)->inRandomOrder()->first();
                $duplicateCheck = TournamentRulesService::alreadyPlayedAgainst($game->winner_id,$opponent->id);
            }
            $game->friends()->sync([$game->winner_id, $opponent->id]);
        });        
    }
}
