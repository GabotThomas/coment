<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LevelUser extends Model
{
    use HasFactory;

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public static function getAll()
    {
        $idUser = Auth::id();
        $levels = LevelUser::with(['levels', 'levels.quizzes'])
            ->with(['levels.quizzes.quizUser' => function ($query) use ($idUser) {
                $query->where('user_id', $idUser);
            }])
            ->where('id', '=', $idUser)
            ->get();

        foreach ($levels as $level) {

            $numberOfQuizz = 0;
            $numberOfQuizzFinished = 0;

            foreach ($level->levels->quizzes  as $quiz) {
                if ($quiz->quizUser->status == 'finish') {
                    $numberOfQuizzFinished++;
                }
                $numberOfQuizz++;
            }

            $resultPourcentage = round($numberOfQuizzFinished / $numberOfQuizz, 2) * 100;
            $level->pourcentage = $resultPourcentage;
        }

        return $levels;
    }

    public static function lastQuizOfLevel($id)
    {
        $idUser = Auth::id();

        $subquery = function ($q) use ($id, $idUser) {
            $q->select([DB::raw('COUNT(questions.id)')])
                ->from('quizzes')
                ->join("quiz_users", "quiz_users.quiz_id", "=", "quizzes.id")
                ->join("questions", "questions.quiz_id", "=", "quizzes.id")
                ->where('quizzes.level_id', '=', $id)
                ->where('quiz_users.user_id', '=', $idUser)
                ->where('quiz_users.status', '=', 'unfinish');
        };

        $lastQuiz = QuizUser::with(['quiz' => function ($q) {
            $q->with('questions');
        }])
            ->addSelect(['totalQuestion' => $subquery])
            ->whereRelation('quiz', 'level_id', '=', $id)
            ->where('user_id', '=', $idUser)
            ->where('status', '=', 'unfinish')
            ->firstOrFail();

        return $lastQuiz;
    }
}
