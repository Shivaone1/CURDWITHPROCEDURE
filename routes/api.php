<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\testController;
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

Route::POST('index', [TestController::class, 'index']);
Route::POST('create', [TestController::class, 'store']);
Route::POST('edit/{id}', [TestController::class, 'update']);
Route::POST('delete/{id}', [TestController::class, 'destroy']);

Route::apiResource('tasks', 'App\Http\Controllers\TaskController');

Route::group(['prefix' => 'tasks'], function () {
    Route::post('/index', [TaskController::class, 'index']);
    Route::post('/create', [TaskController::class, 'store']);
    Route::post('/edit/{id}', [TaskController::class, 'update']);
    Route::post('/delete/{id}', [TaskController::class, 'destroy']);
});
