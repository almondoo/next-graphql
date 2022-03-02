<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Response;

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

Route::middleware('guest:api')->group(function () {
    Route::get('/not-login', function () {
        return response()->fail([
            'unauthenticated' => 'アクセストークンが正しくありません。'
        ], Response::HTTP_UNAUTHORIZED);
    })->name('login');

    Route::get('/', function () {
        return 'guest';
    });
});


// 認証機能
Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest:api')->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
    });
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'logout');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::get('/auth', function () {
        return 'authenticated';
    });
});
