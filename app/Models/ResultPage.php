<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultPage extends Model
{
    use HasFactory;

    public function result(){
        return $this->belongsTo(Result::class);
    }
}
