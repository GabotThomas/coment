<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public function levelUsers()
    {
        return $this->hasMany(LevelUser::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function quizUsers()
    {
        return $this->hasMany(QuizUser::class);
    }

    public static function getAll()
    {
        return Level::with('quizzes')->get();
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $users = User::all();

            foreach ($users as $user) {
                $newLevelUser = new LevelUser();
                $newLevelUser->user_id = $user->id;
                $newLevelUser->level_id = $item->id;
                $newLevelUser->save();
            }
        });
    }
}
