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
Route::get('all_history', [HistoryController::class, 'all_history']);

Route::post('filter_history', [HistoryController::class, 'filter_history']);
Route::get('getuser', [UsersController::class, 'getuser']);
Route::post('insert_history', [HistoryController::class, 'insert_history']);
	});


Route::post('login', [UsersController::class, 'login']);
Route::post('logout', [UsersController::class, 'logout']);
Route::post('register', [UsersController::class, 'register']);