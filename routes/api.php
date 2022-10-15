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

Route::middleware('jwt.auth')->group(function(){
    //AQUI SÕ AS ROTAS PROTEGIDAS
    Route::get('testeJWTlogin', 'App\Http\Controllers\AuthController@index');
});



