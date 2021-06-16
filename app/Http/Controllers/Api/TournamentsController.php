<?php

namespace App\Http\Controllers\Api;

use App\Models\Tournament;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TournamentResource;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;

class TournamentsController extends Controller
{
    public function index()
    {
        return new TournamentResource(Tournament::with(['friends','games'])->get());
    }

    public function store(StoreTournamentRequest $request)
    {
        $tournament = Tournament::create($request->all());

        return (new TournamentResource($tournament))
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tournament $tournament)
    {  
        $tournament = $tournament->load(['friends','games']);
        return new TournamentResource($tournament);
    }

    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $tournament->update($request->all());
        return (new TournamentResource($tournament))
            ->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

