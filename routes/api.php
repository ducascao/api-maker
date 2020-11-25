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

Route::group(['prefix' => 'build'], function () {
    Route::post('/project', 'BuildController@createProject');
    Route::post('/migration', 'BuildController@createMigration');
    Route::post('/model', 'BuildController@createModel');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
