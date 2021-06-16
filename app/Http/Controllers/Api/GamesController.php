<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\StatsService;
use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;

class GamesController extends Controller
{
    public function index(Request $request)
    {
        if($request->name){    
            $searchString = $request->name;           
            return new GameResource(
                Game::whereHas('friends', function ($query) use ($searchString){
                    $query->where('name', 'like', '%'.$searchString.'%');
                })->with('friends')
                ->orderBy('date','desc')
                ->orderBy('id','desc')
                ->get()
            );
        }            
        return new GameResource(Game::with('friends')->orderBy('date','desc')->orderBy('id','desc')->get());
    }

    public function store(StoreGameRequest $request)
    {
        $game = Game::create($request->all());

        StatsService::calculateStats($game);
        StatsService::calculateRankings($game->tournament_id);

        return (new GameResource($game))
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Game $game)
    {  
        return new GameResource($game);
    }

    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->update($request->all());

        StatsService::calculateStats($game);
        StatsService::calculateRankings($game->tournament_id);
        
        return (new GameResource($game))
            ->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
