<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Party;

class PartyController extends Controller {

    public function getParties() {

        try {
            
            return Party::all();

        } 
        
        catch(QueryException $error) {

            return $error;

        }

    }

    public function createParty(Request $request) {

        $user = $request->input('owner');
        $name = $request->input('name');
        $game = $request->input('gameId');

        try {

            Party::create([

                    'owner' => $user,
                    'name' => $name,
                    'gameId' => $game

                ]);

        } 
        
        catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            return response()->json([

                'error' => $codigoError

            ]);
            
        }

    }
    
}
