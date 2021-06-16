<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = "games";
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }   
    
    public function friends()
    {
        return $this->belongsToMany(Friend::class, 'game_friend', 'game_id', 'friend_id');
    }     
}
