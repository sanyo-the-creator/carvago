<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::create($data);

        return [
            'user' => $user,
        ];
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'min:6'],
        ]);

        if(Auth::attempt($loginData)) {
            request()->session()->regenerate();

            return response()->json(['message' => 'logged in successfully'], 200);
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyOutput('email');
    }
}
