<?php

namespace App\Http\Controllers;

use App\Models\LevelUser;
use Illuminate\Http\Request;

class LevelUserController extends Controller
{
    public function index(){
        $levels = LevelUser::getAll();

        return response()->json([
            'levels' => $levels,
        ]);
    }
}
