<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use App\Models\Friend;

class FriendController extends Controller {

    public function addFriend(Request $request){

        $userId1 = $request->input('userId1');
        $userId2 = $request->input('userId2');

        try {

            return Friend::create([

                    'userId1' => $userId1,
                    'userId2' => $userId2

            ]);

        }

        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            if ($errorCode == 1452) {

                return response()->json(['error' => 'friend not found']);

            } else {

                return response()->json(['error' => $errorCode]);

            }
            
        }

    }

    public function showAllFriends(Request $request){

        $id = $request->input('userId');

        try {
            
            return Friend::all()->where('userId1', '=', $id)->where('accepted', '=', 1);

        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function showPendingFriends(Request $request){

        $id = $request->input('userId');

        try {
            
            return Friend::all()->where('userId1', '=', $id)->where('accepted', '=', 0);

        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function acceptFriend(Request $request){

        $userId1 = $request->input('userId1');
        $userId2 = $request->input('userId2');

        try {

            $accept = [

                'userId1' => $request->userId1,
                'userId2' => $request->userId2,
                'accepted' => $request->accepted

            ];

            return Friend::where('userId2', '=', $userId1)->where('userId1', '=', $userId2)->where('accepted', '=', '0')->update($accept);
            
        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function removeFriend(Request $request){

        $userId1 = $request->input('userId1');
        $userId2 = $request->input('userId2');

        $friendFound = Friend::where(function ($query) use($userId1) {
            $query->where('userId1', '=', $userId1)
            ->orWhere('userId2', '=', $userId1);})
            ->where(function ($query) use($userId2) {
            $query->where('userId1', '=', $userId2)
            ->orWhere('userId2', '=', $userId2);});

        if(!$friendFound){

            return response() ->json([

                'success' => false,
                'Friend' => 'Friend not found',

            ], 400);

        }

        if($friendFound -> delete()){

            return response() ->json([

                'success' => true,
                'Friend' => 'Friend deleted',

            ], 200);

        } else {

            return response() ->json([

                'success' => false,
                'Friend' => 'Friend can not be deleted',

            ], 500);

        }

    }
    
}
