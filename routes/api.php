<?php

use App\Http\Controllers\BelongController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
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
    Route::delete('removeUser', [UserController::class, 'removeUser']);

    // Friends table Endpoints

    Route::post('addFriend', [FriendController::class, 'addFriend']);
    Route::post('getFriends', [FriendController::class, 'getFriends']);
    Route::post('getPendingFriends', [FriendController::class, 'getPendingFriends']);
    Route::post('getPendingFriendRequest', [FriendController::class, 'getPendingFriendRequest']);
    Route::put('acceptFriend', [FriendController::class, 'acceptFriend']);
    Route::delete('removeFriend', [FriendController::class, 'removeFriend']);

    // Games table Endpoints

    Route::post('addGame', [GameController::class, 'addGame']);
    Route::get('getGames', [GameController::class, 'getGames']);
    Route::post('getGameById', [GameController::class, 'getGameById']);
    Route::post('getGameByTitle', [GameController::class, 'getGameByTitle']);
    Route::put('updateGame', [GameController::class, 'updateGame']);
    Route::delete('removeGame', [GameController::class, 'removeGame']);

    // Parties table Endpoints  

    Route::post('addParty', [PartyController::class, 'addParty']);
    Route::post('joinParty', [PartyController::class, 'joinParty']);
    Route::get('getParties', [PartyController::class, 'getParties']);
    Route::post('getPartiesByGameId', [PartyController::class, 'getPartiesByGameId']);
    Route::post('getPartiesByGameTitle', [PartyController::class, 'getPartiesByGameTitle']);
    Route::post('getMyParties', [PartyController::class, 'getMyParties']);
    Route::post('getPartyMembers', [PartyController::class, 'getPartyMembers']);
    Route::delete('quitParty', [PartyController::class, 'quitParty']);
    Route::delete('kickFromParty', [PartyController::class, 'kickFromParty']);
    Route::delete('removeParty', [PartyController::class, 'removeParty']);

    // Messages table Endpoints

    Route::get('getMessages', [MessageController::class, 'getMessages']);
    Route::post('addMessage', [MessageController::class, 'addMessage']);
    Route::put('updateMessage', [MessageController::class, 'updateMessage']);
    Route::delete('removeMessage', [MessageController::class, 'removeMessage']);
    Route::post('getPartyMessages', [MessageController::class, 'getPartyMessages']);

});