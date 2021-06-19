<?php

use App\Http\Controllers\Api\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;

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

    // Friends
    Route::post('friend/{id}', [UserController::class, 'newFriend']);
    Route::get('friend', [UserController::class, 'index']);

    // Posts
    Route::post('posts', [PostController::class, 'store']);
    Route::patch('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);

    // Houses
    Route::post('houses', [HouseController::class, 'store']);
    Route::patch('houses/{id}', [HouseController::class, 'update']);
    Route::delete('houses/{id}', [HouseController::class, 'destroy']);
    
    // Activities
    Route::post('activities', [ActivityController::class, 'store']);
    Route::patch('activities/{id}', [ActivityController::class, 'update']);
    Route::delete('activities/{id}', [ActivityController::class, 'destroy']);

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

    // Friends

    // Posts
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{id}', [PostController::class, 'show']);
    
    // Houses
    Route::get('houses', [HouseController::class, 'index']);
    Route::get('houses/{id}', [HouseController::class, 'show']);
    
    // Activities
    Route::get('activities', [ActivityController::class, 'index']);
    Route::get('activities/{id}', [ActivityController::class, 'show']);

    // Statuses
    Route::get('status', [StatusController::class, 'index']);
});