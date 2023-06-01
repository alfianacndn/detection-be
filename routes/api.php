<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HistoryController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});




Route::group(['middleware' => ['auth.jwt']],function ()
{
Route::get('history', [HistoryController::class, 'history']);

Route::post('history_bydate', [HistoryController::class, 'history_bydate']);
Route::post('history_bytime', [HistoryController::class, 'history_bytime']);
Route::post('history_bysearch', [HistoryController::class, 'history_bysearch']);
Route::get('getuser', [UsersController::class, 'getuser']);
Route::post('insert_history', [HistoryController::class, 'insert_history']);
	});


Route::post('login', [UsersController::class, 'login']); 
Route::post('logout', [UsersController::class, 'logout']);
Route::post('register', [UsersController::class, 'register']);