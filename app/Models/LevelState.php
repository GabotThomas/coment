<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LevelState extends Model
{
    use HasFactory;

    public function levels()
    {
        return $this->hasMany(Level::class);
    }


    public static function getAll()
    {
        $idUser = Auth::id();
        $levelStates = LevelState::with(['levels'])
            ->with(['levels.levelUsers' => function ($query) use ($idUser) {
                $query->where('user_id', $idUser);
            }])
            ->with(['levels.quizzes'])
            ->with(['levels.quizzes.quizUser' => function ($query) use ($idUser) {
                $query->where('user_id', $idUser);
            }])
            ->get();

        $isDisabled = false;    

        foreach ($levelStates as $levelState) {
            foreach ($levelState->levels as $index => $level) {

                $numberOfQuizz = 0;
                $numberOfQuizzFinished = 0;

                foreach ($level->quizzes  as $quiz) {
                    if ($quiz->quizUser->status == 'finish') {
                        $numberOfQuizzFinished++;
                    }
                    $numberOfQuizz++;
                }

                $resultPourcentage = round($numberOfQuizzFinished / $numberOfQuizz, 2) * 100;
                $level->pourcentage = $resultPourcentage;

                if($index != 0){
                    if($levelState->levels[$index - 1]->pourcentage != 100){
                        $isDisabled = true;
                    }
                }

                if($isDisabled){
                    $level->disabled = true;
                }

            }
        }
        return $levelStates;
    }
}
