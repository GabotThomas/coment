<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizzesController;
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
Route::get('/quiz/initial', [QuizzesController::class, 'initialQuiz']);
Route::get('/quiz/{id}', [QuizzesController::class, 'show']);
Route::post('/quiz/initial', [QuizzesController::class, 'resultQuizInitial']);

