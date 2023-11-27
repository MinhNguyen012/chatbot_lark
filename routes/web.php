<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\EventLarkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post("/chatbot", [ChatBotController::class,"sendMessageToGroup"]);
Route::get("/a", [ChatBotController::class,"hello"]);
Route::post('/lark-bot', [ChatBotController::class,'handleMessage']);

Route::get('/clickme' , [ChatBotController::class,'getView']);
Route::get('/clickme' , [ChatBotController::class,'getView']);
Route::post('/callback_lark',[EventLarkController::class,'callback_lark']);
