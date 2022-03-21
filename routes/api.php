<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PersonalInformationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
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
//Publikus utak
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::get('/items/search/{name}', [ItemController::class, 'search']);

//Pretektált utak
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
});

//Route::resource('items', ItemController::class);
//Route::get('/items', [ItemController::class, 'index']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/items', ItemController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/reviews', ReviewController::class);
Route::resource('/personal_informations', PersonalInformationController::class);
