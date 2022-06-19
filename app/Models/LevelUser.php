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

    public function levels()
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
}
