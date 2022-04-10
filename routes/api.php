<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PersonalInformationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
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
//Publikus utak
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::get('/items/search/{name}', [ItemController::class, 'search']);
Route::resource('/reviews', ReviewController::class);

//Pretektált utak
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'currentUser']);
    Route::put('/change_password', [UserController::class, 'changePassword']);
    Route::put('/change_username', [UserController::class, 'changeUsername']);
    Route::put('/change_email', [UserController::class, 'changeEmail']);
    Route::resource('/personal_informations', PersonalInformationController::class);
    Route::get('/item/count', [ItemController::class, 'itemCount']);
    Route::get('/user/count', [UserController::class, 'userCount']);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/users', UserController::class);
});


