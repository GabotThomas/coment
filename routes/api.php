<?php

use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LevelStateController;
use App\Http\Controllers\LevelUserController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\ResultController;
use App\Models\LevelUser;
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

Route::get('/quiz/initial', [QuizzesController::class, 'initialQuiz']);
Route::get('/quiz/{id}', [QuizzesController::class, 'show']);
Route::post('/quiz/initial', [QuizzesController::class, 'resultQuizInitial']);


Route::get('/result/initial/{id}', [ResultController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/levelStates', [LevelStateController::class, 'index']);

    Route::get('/level/{id}', [LevelUserController::class, 'lastQuizOfLevel']);

    Route::post('/quiz/save', [ResultController::class, 'createResultQuiz']);

    Route::get('/result/{id}', [ResultController::class, 'showResultQuiz']);
});
