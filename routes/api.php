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

Route::get('user/role', 'App\Http\Controllers\API\UserController@list_role');
Route::post('user/create', 'App\Http\Controllers\API\UserController@create');
Route::post('auth/login', 'App\Http\Controllers\JwtAuthController@login');

Route::group(['middleware' => 'jwt.auth'], function () {

	// ------------------------------------------- USER -------------------------------------------

    Route::post('user-info', 'App\Http\Controllers\JwtAuthController@getUser');
    Route::post('user/customer', 'App\Http\Controllers\API\UserController@list_customer');
    Route::post('user/historial', 'App\Http\Controllers\API\UserController@historial');

    // ------------------------------------------- CONSULTA -------------------------------------------

    Route::post('consulting/save', 'App\Http\Controllers\ConsultationController@create');
    Route::post('consulting/get', 'App\Http\Controllers\ConsultationController@list_consulting');

    // ------------------------------------------- EXAMEN -------------------------------------------

    Route::post('exam/save', 'App\Http\Controllers\ExamController@create');
    Route::post('exam/get', 'App\Http\Controllers\ExamController@list_exam');

});