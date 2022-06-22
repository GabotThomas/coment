<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

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

    public function resultQuizInitial(Request $request)
    {
        $quizInitial =  Quiz::findInitalQuiz();
        $QuestionsWithResult = $request->quiz["questions"];

        $numberOfQuestion = 0;
        $answerGood = 0;

        foreach ($QuestionsWithResult as $question) {
            if ($question['is_sexist'] == $question['result']) {
                $answerGood++;
            }
            $numberOfQuestion++;
        }

        $resultPourcentage = round($answerGood / $numberOfQuestion, 2) * 100;

        $result = Result::find(1);

        return response()->json([
            'pourcentage' => $resultPourcentage,
            'result' => $result->id
        ]);
    }

    public function resultQuiz(Request $request)
    {
        
    }
}
