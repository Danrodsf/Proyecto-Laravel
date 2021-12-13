<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {

    public function addFriend(Request $request){

        $userId1 = Auth::id();
        $userId2 = $request->input('userId2');

        try {

            $friend = Friend::where(function ($query) use($userId1) {
            $query->where('userId1', '=', $userId1)
            ->orWhere('userId2', '=', $userId1);})
            ->where(function ($query) use($userId2) {
            $query->where('userId1', '=', $userId2)
            ->orWhere('userId2', '=', $userId2);})
            ->get();

            if ($friend->isEmpty()) {

                return Friend::create([

                    'userId1' => $userId1,
                    'userId2' => $userId2

                ]);

            } else {

                return response() ->json([

                'success' => false,
                'Friend' => 'You are already Friends',

                ], 500);

            }

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

    public function getFriends(){

        $id = Auth::id();

        try {
            
            return Friend::all()->where('userId1', '=', $id)->where('accepted', '=', 1);

        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function getPendingFriends(){

        $id = Auth::id();

        try {
            
            return Friend::all()->where('userId1', '=', $id)->where('accepted', '=', 0);

        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function getPendingFriendRequest(){

        $id = Auth::id();

        try {
            
            return Friend::all()->where('userId2', '=', $id)->where('accepted', '=', 0);

        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function acceptFriend(Request $request){

        $userId1 = Auth::id();
        $userId2 = $request->input('userId2');

        try {

            $accept = [

                'accepted' => $request->accepted

            ];

            return Friend::where('userId2', '=', $userId1)->where('userId1', '=', $userId2)->where('accepted', '=', '0')->update($accept);
            
        } 
        
        catch(QueryException $error) {

            return $error;

        }
        
    }

    public function removeFriend(Request $request){

        $userId1 = Auth::id();
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
                'Error' => 'Friend not found',

            ], 400);

        }

        if($friendFound -> delete()){

            return response() ->json([

                'success' => true,
                'Error' => 'Friend deleted',

            ], 200);

        } else {

            return response() ->json([

                'success' => false,
                'Error' => 'Friend can not be deleted',

            ], 500);

        }

    }
    
}
