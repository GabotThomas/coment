<?php

use App\Http\Controllers\Admin\QuizzesController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AuthController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/admin/login', [AuthController::class, 'loginAdmin']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('admin')->group(function () {
        //Category
        Route::post('/admin/quiz', [AdminQuizController::class, 'create']);
    });
});
