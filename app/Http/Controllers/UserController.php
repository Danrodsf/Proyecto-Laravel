<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;

class UserController extends Controller {
    
    public function getAll(){

        try {
            
            return User::all();

        } 
        
        catch(QueryException $error) {

            return $error;

        }

    }

    public function getProfile(Request $request){

        $id = $request->input('id');

        try {

            return User::all()->where('id', '=', $id)->makeHidden(['password'])->keyBy('id');

        } 
        
        catch (QueryException $error) {

            return $error;

        }

    }
    
    public function updateProfile(Request $request){

        $id = $request->input('id');

        $this->validate($request, [

            'id' => 'required',
            'userName' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'steamUserName' => 'required|string|min:6'

        ], [

            'userName' => 'UserName is required',
            'email' => 'Email is required',
            'password' => 'Password is required',
            'steamUserName' => 'SteamUserName is required'

        ]);

    
        try {

            $validatedUpdate = [

                'userName' => $request->userName,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'steamUserName' => $request->steamUserName

            ];

            return User::where('id', '=', $id)->update($validatedUpdate);

        } catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            if($errorCode == 1062) {

                return response()->json(['error' => "E-mail already Registered"]);

            }

        }

    }    

}
