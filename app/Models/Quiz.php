<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public static function findQuiz($id) {
        return Quiz::with('questions')->where('id', '=', $id)
            ->firstOrFail();
    }
}
