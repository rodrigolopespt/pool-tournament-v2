<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $table = "friends";
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_friend', 'friend_id', 'game_id')->with('friends');
    } 

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'tournament_friend', 'friend_id', 'tournament_id')
            ->withPivot('games_played','points','wins','balls_left','current_rank')
            ->as('tournaments');;
    }
    
}
