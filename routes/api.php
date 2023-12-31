<?php

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

Route::post("register", "App\Http\Controllers\AuthController@register");
Route::post("login", "App\Http\Controllers\AuthController@login");
Route::apiResource("todos", "App\Http\Controllers\TodoController");
Route::post('todos/deleteMany', 'App\Http\Controllers\TodoController@deleteMany');
Route::middleware('auth:sanctum')->group(function () {
    Route::post("logout", "App\Http\Controllers\AuthController@logout");
});

Route::get('/', function () {
    return 'test';

});
