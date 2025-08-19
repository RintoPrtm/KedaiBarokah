<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    //Form Login
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Logout user lama sebelum login user baru
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            $user = Auth::user();
            $user->current_session_id = session()->getId();
            $user->save();
        
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;
        
            if ($user->rule == 'admin') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/tampilUser');
            }
        }
    
        throw ValidationException::withMessages([
            'username' => ['Username atau password salah!'],
        ]);
    }

    //Form Register
    public function showRegisterForm()
    {
        return view('register');
    }

    public function daftar(Request $request)
    {

        $validated = $request->validate([
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
            'telp_user' => 'required|string|max:15',
            'rule' => 'nullable|string|exists:rule,rule',
        ]);


        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telp_user' => $request->telp_user,
            'rule' => $request->rule ?? 'user',
        ]);

        return redirect('/login');

    }

public function logout(Request $request)
{
    $user = $request->user();
    
    if ($user) {
        $user->tokens()->delete();
    }

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');

}

    public function ME()
    {
        return response(['data' => auth()->user()]);
    }

}
