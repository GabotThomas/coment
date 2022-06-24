<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::getAll();
        return response([
            "quizzes" => $quizzes,
        ], 200);
    }

    public function create(Request $request)
    {
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->save();

        $quiz->questions()->createMany($request->questions);

        return response([
            "quiz" => $quiz,
            "message" => 'Editer'
        ], 200);
    }
}
