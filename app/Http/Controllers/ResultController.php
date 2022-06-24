<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizUser;
use App\Models\Result;
use App\Models\ResultUser;
use App\Service\ResultService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request)
    {
        $result = Result::findResult($request->id);

        return response()->json([
            'result' => $result,
        ]);
    }

    public function createResultQuiz(Request $request)
    {
        $newQuiz = $request->quiz;
        $quizUser =  QuizUser::findUserQuiz($newQuiz['id']);
        $QuestionsWithResult = $newQuiz["questions"];

        $numberOfQuestion = 0;
        $answerGood = 0;

        foreach ($QuestionsWithResult as $question) {
            if ($question['is_sexist'] == $question['result']) {
                $answerGood++;
            }
            $numberOfQuestion++;
        }

        $resultPourcentage = round($answerGood / $numberOfQuestion, 2) * 100;

        $resulId = ResultService::getResult($resultPourcentage);
        $result = Result::find($resulId);

        $newResultUser = new ResultUser();
        $newResultUser->result_id = $result->id;
        $newResultUser->quiz_user_id = $quizUser->id;
        $newResultUser->score = $resultPourcentage;
        $newResultUser->save();

        $quizUser->status = 'finish';
        $quizUser->save();

        return response()->json([
            'resultUser' => $newResultUser->id
        ]);
    }

    public function showResultQuiz(Request $request)
    {
        $resultUser = ResultUser::getOne($request->id);

        return response()->json([
            'resultUser' => $resultUser
        ]);
    }
}
