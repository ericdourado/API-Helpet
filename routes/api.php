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
Route::post('login', 'App\Http\Controllers\AuthController@login');
// Route::get('login', 'App\Http\Controllers\AuthController@index');
// Route::apiResource('usuario', 'App\Http\Controllers\UsuarioController');


Route::middleware('jwt.auth')->group(function(){
    // Route::apiresource('usuario', 'App\Http\Controllers\UsuarioController');
    Route::apiResource('usuario', 'App\Http\Controllers\UsuarioController');
    // Route::delete('login/{id}', 'App\Http\Controllers\AuthController@destroy');
});




