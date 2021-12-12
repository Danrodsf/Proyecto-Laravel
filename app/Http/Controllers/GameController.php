<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Game;

class GameController extends Controller {

    public function addGame(Request $request) {

        $title = $request->input('title');
        $thumbnail = $request->input('thumbnail');
        $url = $request->input('url');

        try {

            Game::create([

                    'title' => $title,
                    'thumbnail' => $thumbnail,
                    'url' => $url

                ]);

        } 
        
        catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            return response()->json([

                'error' => $codigoError

            ]);
            
        }

    }

    public function getGames() {

        try {
            
            return Game::all();

        } 
        
        catch(QueryException $error) {

            return $error;

        }

    }

    public function updateGame(Request $request) {

        $id = $request->input('id');

        $this->validate($request, [

            'id' => 'required',
            'title' => 'required|string|min:3',
            'thumbnail' => 'required|min:6',
            'url' => 'required|string|min:6'

        ], [

            'title' => 'title is required',
            'thumbnail' => 'thumbnail is required',
            'url' => 'url is required',

        ]);

    
        try {

            $validatedUpdate = [

                'title' => $request->title,
                'thumbnail' => $request->thumbnail,
                'url' => $request->url

            ];

            return Game::where('id', '=', $id)->update($validatedUpdate);

        } 
        
        catch (QueryException $error) {

            return $error;

        }

    }
    
    public function removeGame(Request $request) {

        $id = $request->input('id');

        try {

            return Game::where('id', '=', $id)->delete($id);

        } 
        
        catch (QueryException $error) {

            return $error;

        }

    }

}
