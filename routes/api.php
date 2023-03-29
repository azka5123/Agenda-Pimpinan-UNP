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

//api login
Route::post('/user/login', [ApiLoginController::class, 'api_login']);
Route::get('/user/logout', [ApiLoginController::class, 'api_logout'])->middleware('auth:sanctum');
//end api login

//api jadwal
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/data-user', [ApiUserController::class, 'user']);
    Route::post('/user/store', [ApiUserController::class, 'store']);
    Route::put('/user/update/{id}', [ApiUserController::class, 'update'])->middleware('pemilik_jadwal');
    Route::delete('/user/delete/{id}', [ApiUserController::class, 'delete'])->middleware('pemilik_jadwal');
});
Route::get('/user/index', [ApiUserController::class, 'index']);
Route::get('/user/show/{id}', [ApiUserController::class, 'show']);
//api jadwal end
