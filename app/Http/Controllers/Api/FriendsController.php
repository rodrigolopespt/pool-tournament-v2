<?php

namespace App\Http\Controllers\Api;

use App\Models\Friend;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FriendResource;
use App\Http\Requests\StoreFriendRequest;
use App\Http\Requests\UpdateFriendRequest;

class FriendsController extends Controller
{
    public function index()
    {
        return new FriendResource(Friend::with(['tournaments','games'])->get());
    }

    public function store(StoreFriendRequest $request)
    {
        $friend = Friend::create($request->all());

        return (new FriendResource($friend))
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Friend $friend)
    {  
        $friend->load(['tournaments','games']);
        return new FriendResource($friend);
    }

    public function update(UpdateFriendRequest $request, Friend $friend)
    {
        $friend->update($request->all());
        return (new FriendResource($friend))
            ->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Friend $friend)
    {
        $friend->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
