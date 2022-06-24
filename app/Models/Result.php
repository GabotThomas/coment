<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Result extends Model
{
    use HasFactory;

    public function resultPages(){
        return $this->hasMany(ResultPage::class);
    }

    public static function findResult($id)
    {
        $subquery = function ($q) use($id) {
            $q->select([DB::raw('COUNT(result_pages.id)')])
                ->from('results')
                ->join("result_pages", "result_pages.result_id", "=", "results.id")
                ->where('results.id', '=', $id);
        };

        $query = Result::with('resultPages')
            ->addSelect(['totalPages' => $subquery])
            ->where('id', '=', $id)
            ->firstOrFail();

        return $query;
    }
}
