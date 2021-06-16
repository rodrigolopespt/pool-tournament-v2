<?php

namespace App\Models;

use App\Models\Game;
use App\Models\Friend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    protected $table = "tournaments";
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function games()
    {
        return $this->hasMany(Game::class,'tournament_id')
            ->orderBy('date','desc')
            ->with('friends');
    }
  
    public function friends()
    {
        return $this->belongsToMany(Friend::class, 'tournament_friend','tournament_id','friend_id')
            ->withPivot('games_played','points','wins','balls_left','current_rank')
            ->as('tournaments')
            ->orderBy('points','desc')
            ->orderBy('balls_left','asc')
            ->orderBy('current_rank','asc');
    }    
}
