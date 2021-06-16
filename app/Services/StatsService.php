<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Friend;
use App\Models\Tournament;

class StatsService
{
    public static function calculateStats($game = null): void
    {   
        if($game){
            $friends = Friend::with('games')->whereIn('id',$game->friends)->get();
        } else {
            $friends = Friend::with('games')->get();
        }

        $friends->each(function($friend) {           
            foreach($friend->games as $game){
                if(!isset($friend_stats[$game->tournament_id])){
                    $friend_stats[$game->tournament_id]['games_played'] = 0;
                    $friend_stats[$game->tournament_id]['points'] = 0;
                    $friend_stats[$game->tournament_id]['wins'] = 0;
                    $friend_stats[$game->tournament_id]['balls_left'] = 0;
                }

                $friend_stats[$game->tournament_id]['games_played'] = $friend_stats[$game->tournament_id]['games_played'] + 1;
                if($game->winner_id == $friend->id){
                    $friend_stats[$game->tournament_id]['points'] = $friend_stats[$game->tournament_id]['points'] + 3;
                    $friend_stats[$game->tournament_id]['wins'] = $friend_stats[$game->tournament_id]['wins'] + 1;
                } else {
                    $friend_stats[$game->tournament_id]['points'] =  $game->no_show == 1 ? $friend_stats[$game->tournament_id]['points'] : $friend_stats[$game->tournament_id]['points'] + 1;
                    $friend_stats[$game->tournament_id]['balls_left'] = $friend_stats[$game->tournament_id]['balls_left'] + $game->balls_left;
                }
            }

            /* dd(count($friend_stats)); */
            if(isset($friend_stats) && count($friend_stats) > 0){
                foreach($friend_stats as $key => $stats){
                    $friend->tournaments()->syncWithPivotValues([
                        'tournament_id' => $key
                    ],
                    [
                        'friend_id' => $friend->id,
                        'games_played' => $stats['games_played'],
                        'points' => $stats['points'],
                        'wins' => $stats['wins'],
                        'balls_left' => $stats['balls_left'],
                    ]);
                }
            }
            
            /* $friend->tournamentStats()->delete(); */
            
            unset($friend_stats);

            echo "Global Stats Calculated for friend ".$friend->name."\n";          
        });   
        
        echo "Global Stats Calculation End. - ".Carbon::now()."\n";
    } 

    public static function calculateRankings($tournament = null): void
    {       
        if($tournament){
            $tournaments = Tournament::find($tournament->id)->with('friends')->get()->toArray();
        } else {
            $tournaments = Tournament::with('friends')->get()->toArray();    
        }
        $tournaments = Tournament::with('friends')->get()->toArray();
        foreach($tournaments as $key => $tournament){
            foreach($tournament['friends'] as $key => $friend) {
                if ($key > 0) {
                    if (($tournament['friends'][$key - 1]['tournaments']['points'] == $tournament['friends'][$key]['tournaments']['points']) && ($tournament['friends'][$key - 1]['tournaments']['balls_left'] == $tournament['friends'][$key]['tournaments']['balls_left'])) {
                        $tournament['friends'][$key]['tournaments']['current_rank'] = $tournament['friends'][$key - 1]['tournaments']['current_rank'];
                    } else {
                        $tournament['friends'][$key]['tournaments']['current_rank'] = $key + 1;
                    }
                } else {
                    $tournament['friends'][$key]['tournaments']['current_rank'] = $key + 1;
                }
                Friend::find($friend['id'])->tournaments()->updateExistingPivot([
                        $tournament['id']
                    ],
                    ['current_rank' => $tournament['friends'][$key]['tournaments']['current_rank']
                ]);
            } 

            echo "Ranking Calculated for tournament ".$tournament['name']."\n";
        };

        echo "Rankings Calculation End. - ".Carbon::now()."\n";
    }         
}
