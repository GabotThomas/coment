<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultUser extends Model
{
    use HasFactory;

    public function result()
    {
        return $this->hasOne(Result::class, 'id', 'result_id');
    }

    public static function getOne($id)
    {
        $idUser = Auth::id();

        $subquery = function ($q) use ($id) {
            $q->select([DB::raw('COUNT(result_pages.id)')])
                ->from('result_users')
                ->join("result_pages", "result_pages.result_id", "=", "result_users.result_id")
                ->where('result_users.id', '=', $id);
        };

        return ResultUser::with(['result' => function ($q) use ($subquery) {
            $q->with('resultPages')->addSelect(['totalPages' => $subquery]);
        }])
            ->where('id', '=', $id)
            ->firstOrFail();
    }
}
