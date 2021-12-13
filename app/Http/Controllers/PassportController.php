<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller {

    public function signUp(Request $request) {

        $this->validate($request, [

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

            $user = User::create([

                'userName' => $request->userName,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'steamUserName' => $request->steamUserName

            ]);

        } 
        
        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            if ($errorCode == 1062) {

                return response()->json(['error' => 'Email already registered']);

            }

        }

        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['token' => $token], 200);

    }

    public function signIn(Request $request) {

        $login = [

            'email' => $request->email,
            'password' => $request->password

        ];

        if (auth()->attempt($login)) {

            $token = auth()->user()->createToken('LaravelAuthApp') -> accessToken;
            return response()->json(['token' => $token], 200);

        } else {

            return response()->json(['error' => 'You are not Authorized'], 401);

        }

    }

    public function logout() { 

        $user = Auth::user()->token();

        try {

            $user->revoke();
            return 'logged out';

        } 
        
        catch (QueryException $error) {

            return $error;

        }
        
    }

}

?>