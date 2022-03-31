<?php

namespace App\Http\Controllers;

use App\Models\GamePlay;
use Illuminate\Http\Request;

class GamePlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gamePlays = GamePlay::paginate();

        if ($gamePlays) {
            return response()->json($gamePlays, 200);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json(['error' => 'Something went wrong'], 500);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $validatedData = $request->validate([
            'location' => 'required|string|max:64',
            'scene' => 'required|string|max:64',
            'right_attempt' => 'nullable|integer',
            'wrong_attempt' => 'nullable|integer',
            // 'total_attempt' => 'nullable|integer',
            'total_time' => 'nullable|integer',
        ]);

        $gamePlay = new GamePlay();
        $gamePlay->location = $request->location;
        $gamePlay->scene = $request->scene;
        $gamePlay->right_attempt = $request->right_attempt;
        $gamePlay->wrong_attempt = $request->wrong_attempt;
        $gamePlay->total_attempt = $request->right_attempt + $request->wrong_attempt;
        $gamePlay->total_time = $request->total_time;
        $gamePlay->save();

        if ($gamePlay) {
            return response()->json($gamePlay, 201);
        } else {
            return response()->json(['error' => 'Data does not stored'], 400);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GamePlay  $gamePlay
     * @return \Illuminate\Http\Response
     */
    public function show(GamePlay $gamePlay)
    {
        if ($gamePlay) {
            return response()->json($gamePlay, 200);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GamePlay  $gamePlay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GamePlay $gamePlay)
    {
        // validate request
        $validatedData = $request->validate([
            'location' => 'nullable|string|max:64',
            'scene' => 'nullable|string|max:64',
            'right_attempt' => 'nullable|integer',
            'wrong_attempt' => 'nullable|integer',
            // 'total_attempt' => 'nullable|integer',
            'total_time' => 'nullable|integer',
        ]);

        if ($gamePlay) {
            // update game play
            $gamePlay->location = $request->location;
            $gamePlay->scene = $request->scene;
            $gamePlay->right_attempt = $request->right_attempt;
            $gamePlay->wrong_attempt = $request->wrong_attempt;
            $gamePlay->total_attempt = $request->right_attempt + $request->wrong_attempt;
            $gamePlay->total_time = $request->total_time;
            $gamePlay->save();

            return response()->json($gamePlay, 200);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GamePlay  $gamePlay
     * @return \Illuminate\Http\Response
     */
    public function destroy(GamePlay $gamePlay)
    {
        if ($gamePlay) {
            $gamePlay->delete();
            return response()->json(['success' => 'Data deleted'], 204);
        } else {
            return response()->json(['error' => 'Data found'], 404);
        }

        return response()->json(['error' => 'Something went wrong'], 500);
    }
}
