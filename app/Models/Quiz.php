<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quiz extends Model
{
    use HasFactory;

    protected $fillables = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function getAll()
    {
        return Quiz::with("id")->get();
    }

    public static function getOne(int $id)
    {
        return Quiz::where('id', '=', $id)
            ->firstOrFail();
    }

    public static function getByIds(array $ids)
    {
        return Quiz::whereIn("id", $ids)->get();
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
