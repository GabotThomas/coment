<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->morphOne(User::class, 'user');
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }

    public static function findInitalQuiz($idUser)
    {
        return QuizUser::whereRelation('quiz', 'is_initial', 1)
            ->where('user_id', '=', $idUser)
            ->firstOrFail();
    }
}
