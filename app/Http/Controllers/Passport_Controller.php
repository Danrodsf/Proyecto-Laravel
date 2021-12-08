<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gamers_Model;
use Illuminate\Database\QueryException;

class Passport_Controller extends Controller
{
    
    public function signUp(Request $request){

        $this -> validate($request, [

            'nick'=>'required|string|min:3',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'steamUsername'=>'required|min:3'

        ], [

            'nick'=>'Nick is required',
            'email'=>'email is required',
            'password'=>'password is required',
            'steamUsername'=>'steamUsername is required'

        ]);

        try {
            
            $gamer = Gamers_Model::create([

                'nick' => $request->nick,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'steamUsername' => $request->steamUsername

            ]);

        } catch (QueryException $error) {
            
            $errorCode = $error->errorInfo[1];

            if($errorCode == 1062) {

                return response()->json([

                    'error' => "This E-mail is already registered"

                ]);

            }

        }

        $token = $gamer -> createToken('LaravelAuthApp') -> accessToken;
        return response()->json(['token' => $token], 200);

    }

    public function signIn(Request $request){

        $data = [

            'email' => $request -> email,
            'password' => $request -> password,

        ];

        if (auth() -> attempt($data)) {
            
            $token = auth() -> user() -> createToken('LaravelAuthApp') -> AccessToken;
            return response() -> json(['token' => $token], 200);

        } else {

            return response() -> json(['error' => 'Unauthorized'], 401);

        }

    }

    public function logout(Request $request){

        //idle...does nothing.......
        
    }

}
