<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function login(Request $request)
    {
        $messages = [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'password.required' => __('auth.password_required'),
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], $messages);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['login_time' => now()]);
            return redirect()->route('dashboard')->with('success', __('auth.login_success') . ' ' . Auth::user()->name);
        }

        return back()->with('error', __('auth.login_failed'))->withInput($request->only('email'));
    }

    public function register_process(Request $request)
    {
        $messages = [
            'name.required' => __('auth.name_required'),
            'name.min' => __('auth.name_min'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'email.unique' => __('auth.email_unique'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.confirmed' => __('auth.password_confirmed'),
        ];

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ], $messages);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', __('auth.register_success'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', __('auth.logout_success'));
    }
}
