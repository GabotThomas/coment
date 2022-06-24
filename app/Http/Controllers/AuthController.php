<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
        } catch (ValidationException $e) {
            dd($e->errors());
        }
        
        $user = User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        
        if(!empty($request->quiz)){
            $quizInitialUser = QuizUser::findInitalQuiz($user->id);
            $quizInitialUser->status = 'finish';
            $quizInitialUser->save();
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request, $isAdmin = false)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $query = User::where('email', $request['email']);

        if ($isAdmin === true) {
            $query = $query->where('role', '=', 'admin');
        }

        $user = $query->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function loginAdmin(Request $request)
    {
        return $this->login($request, true);
    }

    public function user()
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ]);
    }
}
