<?php

namespace App\Http\Controllers;

use App\Models\LevelState;
use Illuminate\Http\Request;

class LevelStateController extends Controller
{
    public function index(){
        $levelStates = LevelState::getAll();

        return response()->json([
            'levelStates' => $levelStates,
        ]);
    }
}
