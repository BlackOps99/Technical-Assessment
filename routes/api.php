<?php


use App\Http\Controllers\Api\Auth\AuthenticatedUserController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\PartitionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    //User Authenticated
    Route::controller(AuthenticatedUserController::class)->group(function () {
        Route::post('/auth/login', 'authenticate');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::post('/auth/register', 'register');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    //User Auth Logout
    Route::post('/auth/destroy', [AuthenticatedUserController::class, 'destroy']);

    Route::apiResource('/categories', CategoriesController::class);

    Route::apiResource('/partitions', PartitionsController::class);

    Route::apiResource('/items', ItemsController::class);
});
