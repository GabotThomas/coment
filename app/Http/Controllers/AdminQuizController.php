<?php

namespace App\Http\Controllers;

use App\Models\Admin\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQuizController extends Controller
{
    public function index() {
        $quizzes = Quiz::getAll();
        return response([
            "quizzes" => $quizzes,
        ], 200);
    }

    public function create(Request $request) {
        $quiz = new Quiz();

        foreach ($request->all() as $key => $param) {
            if (!is_null($param)) {
                if (!is_array($param)) {
                    $quiz->$key = $param;
                } else {
                    $class = 'App\Models\\' . Str::ucfirst($key);
                    $object = $class::updateOrCreate($param);
                    $quiz->$key()->associate($object);
                }
            }
        }

        $quiz->save();

        return response([
            "quiz" => $quiz,
            "message" => 'Editer'
        ], 200);
    }
}
