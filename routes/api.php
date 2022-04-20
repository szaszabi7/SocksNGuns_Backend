<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;
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
Route::group(['middleware' => ['auth:sanctum'/* , 'abilities:is-admin' */]], function () {

    /* #region  Admin */
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);

    Route::get('/item/count', [ItemController::class, 'itemCount']);
    Route::get('/user/count', [UserController::class, 'userCount']);
    Route::get('/order/count', [OrderController::class, 'orderCount']);
    Route::get('/order/new/count', [OrderController::class, 'newOrderCount']);
    Route::get('/orders/new', [OrderController::class, 'getNewOrders']);

    Route::resource('/categories', CategoryController::class);
    Route::resource('/users', UserController::class);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::put('/orders/{order}', [OrderController::class, 'update']);
    Route::post('/orders/new', [OrderController::class, 'order']);
    /* #endregion */

    /* #region  User */
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', [AuthController::class, 'currentUser']);

    Route::put('/change_password', [UserController::class, 'changePassword']);
    Route::put('/change_username', [UserController::class, 'changeUsername']);
    Route::put('/change_email', [UserController::class, 'changeEmail']);

    Route::post('/personal_information', [PersonalInformationController::class, 'store']);
    Route::get('/personal_information', [PersonalInformationController::class, 'show']);
    Route::put('/personal_information/{id}', [PersonalInformationController::class, 'update']);
    Route::delete('/personal_information/{id}', [PersonalInformationController::class, 'destroy']);

    Route::get('/user/orders', [OrderController::class, 'userOrders']);
    Route::get('/order_items/{id}', [OrderItemController::class, 'show']);
    /* #endregion */

    Route::delete('/orders/{order}', [OrderController::class, 'destroy']);

    //Route::get('/order_items', [OrderItemController::class, 'index']);
    Route::post('/order_items', [OrderItemController::class, 'store']);
});
