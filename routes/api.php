<?php

use App\Http\Controllers\ChatBotController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get-access', [ChatBotController::class,'getTenantAccessToken']);
Route::get('/get-chats', [ChatBotController::class,'getAllChats']);
Route::post('/send-message', [ChatBotController::class,'sendmessageToGroup'])->name("send-messenger");
