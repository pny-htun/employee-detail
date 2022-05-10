<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegistrationController;

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

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group( function () {

    Route::group(['prefix' => 'employees'], function () {
        Route::post('register', [RegistrationController::class, 'register']);
        Route::get('show', [RegistrationController::class, 'show']);
        Route::patch('update', [RegistrationController::class, 'update']);
        Route::delete('delete/{id}', [RegistrationController::class, 'delete']);
    });
    
});
