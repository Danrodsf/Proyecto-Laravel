<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('signUp', [PassportController::class, 'signUp']);
Route::post('signIn', [PassportController::class, 'signIn']);

Route::middleware('auth:api')->group(function(){

    // Users table Endpoints

    Route::post('logout', [PassportController::class, 'logout']);
    Route::get('getAll', [UserController::class, 'getAll']);
    Route::post('getProfile', [UserController::class, 'getProfile']);
    Route::put('updateProfile', [UserController::class, 'updateProfile']);

    // Friends table Endpoints

    Route::post('addFriend', [FriendController::class, 'addFriend']);
    Route::post('showAllFriends', [FriendController::class, 'showAllFriends']);
    Route::post('showPendingFriends', [FriendController::class, 'showPendingFriends']);
    Route::put('acceptFriend', [FriendController::class, 'acceptFriend']);
    Route::delete('removeFriend', [FriendController::class, 'removeFriend']);


});