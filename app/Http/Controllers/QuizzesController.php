<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizzesController extends Controller
{
    public function show(Request $request)
    {
        return Quiz::findQuiz($request->id);
    }

    public function initialQuiz()
    {
        $quiz =  Quiz::findInitalQuiz();

        return response()->json([
            'quiz' => $quiz,
        ]);
    }
}
