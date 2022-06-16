<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

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
}
