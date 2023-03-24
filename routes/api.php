<?php

use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api login
Route::post('/user/login', [ApiLoginController::class, 'api_login']);
//end api login

//api jadwal
Route::get('/user/index', [ApiUserController::class, 'index']);
Route::get('/user/show/{id}', [ApiUserController::class, 'show']);
Route::post('/user/store', [ApiUserController::class, 'store']);
Route::put('/user/update/{id}', [ApiUserController::class, 'update']);
Route::get('/user/delete/{id}', [ApiUserController::class, 'delete']);
//api jadwal end
