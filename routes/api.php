<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserTestController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function () {
        return auth()->user();
    });

    Route::resource('/users', 'UserController')->only(['index', 'show', 'update', 'destroy']);

    Route::resource('/tests', 'UserTestController')->only(['index', 'show', 'store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
