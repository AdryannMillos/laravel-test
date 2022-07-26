<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;
use Modules\Users\Http\Controllers\AuthController;

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

Route::post('/users/create', [UserController::class, 'store']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['apiJwt']], function(){
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
