<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->morphOne(User::class,'user');
    }

    public function quiz()
    {
        return $this->morphOne(Quiz::class,'quiz');
    }
}
