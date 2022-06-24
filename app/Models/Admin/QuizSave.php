<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSave extends Model
{
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public static function getByProductIdAndVersion(Quiz $quiz)
    {
        return QuizSave::where("product_id", "=", $quiz->id)
            ->where('version', '=', $quiz->version)
            ->first();
    }

    public static function getOrCreate(Quiz $quiz)
    {
        $quizSave =  QuizSave::getByProductIdAndVersion($quiz);
        if(is_null($quizSave)){
           $quizSave = new QuizSave();
           $quizSave->product_id = $quiz->id;
           $quizSave->name = $quiz->name;
           $quizSave->version = $quiz->version;


           $quizSave->save();
        }

        return $quizSave;
    }
}
