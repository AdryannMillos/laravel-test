<?php

use Illuminate\Support\Facades\Route;
use Modules\Tasks\Http\Controllers\TaskController;
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

Route::group(['middleware' => ['apiJwt']], function(){
    Route::post('/tasks/create', [TaskController::class, 'store']);
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::put('/tasks/{id}/update', [TaskController::class, 'update']);
});
