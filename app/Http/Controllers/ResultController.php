<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request){
        $result = Result::findResult($request->id);

        return response()->json([
            'result' => $result,
        ]);
    }
}
