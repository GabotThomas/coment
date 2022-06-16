<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function findQuiz($id)
    {
        return Quiz::with('questions')->where('id', '=', $id)
            ->firstOrFail();
    }

    public static function findInitalQuiz()
    {
        $subquery = function ($q) {
            $q->select([DB::raw('COUNT(questions.id)')])
                ->from('quizzes')
                ->join("questions", "questions.quiz_id", "=", "quizzes.id")
                ->where('quizzes.is_initial', '=', 1);
        };

        $query = Quiz::with('questions')
            ->addSelect(['totalQuestion' => $subquery])
            ->where('is_initial', '=', 1)
            ->firstOrFail();

        return $query;
    }
}
