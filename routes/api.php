<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\AuthController;

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


Route::group([

    'middleware' => 'api',
    'prefix' => 'v1/auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']); // Profile

});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'v1/user'
], function() {
    Route::get('me', [AuthController::class, 'me']);
    // Posts
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
    // Statuses
    Route::post('status', [StatusController::class, 'store']);
    Route::get('status', [StatusController::class, 'index']);
    // Route::post('image-upload', [UserFileController::class, 'store']);
    // Route::get('add_friend/{id}', [UserFileController::class, 'addFriend']);
});


// Public Routes
Route::group([
    'prefix' => 'v1/user'
], function() {
    // Posts
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{id}', [PostController::class, 'show']);
    // Statuses
    Route::get('status', [StatusController::class, 'index']);
});