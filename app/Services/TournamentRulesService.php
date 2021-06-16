<?php

namespace App\Services;

use App\Models\Friend;
use Illuminate\Support\Facades\DB;

class TournamentRulesService
{
    public static function alreadyPlayedAgainst($friend1,$friend2): bool
    {
        $friend = Friend::find($friend1);

        $played_against = DB::table('game_friend')
            ->whereIn('game_id',$friend->games()->pluck('id'))
            ->where('friend_id','<>',$friend->id)
            ->pluck('friend_id')
            ->toArray();
        
        if (in_array($friend2, $played_against)) {
            return true;
        }

        return false;
    } 
}
