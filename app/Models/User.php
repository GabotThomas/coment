<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            $levels = Level::getAll();

            foreach($levels as $level){
                $newLevelUser = new LevelUser(); 
                $newLevelUser->user_id = $item->id;
                $newLevelUser->level_id = $level->id;
                foreach($level['quizzes'] as $quiz){
                    $newQuizUser = new QuizUser();
                    $newQuizUser->user_id = $item->id;
                    $newQuizUser->quiz_id = $quiz->id;
                    $newQuizUser->status = 'unfinish';
                    $newQuizUser->save();
                }
                $newLevelUser->save();
            }
        });
    }
}
