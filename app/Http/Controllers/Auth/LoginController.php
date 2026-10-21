<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $adminEmail = config('admin.email', env('ADMIN_EMAIL', 'admin@uacjp.uz'));
        $adminPassword = config('admin.password', env('ADMIN_PASSWORD', 'admin12345'));

        if ($validated['email'] !== $adminEmail || ! Hash::check($validated['password'], $adminPassword)) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        Session::put('admin_authenticated', true);
        Session::put('admin_email', $validated['email']);

        return redirect()->route('admin.join.index')
            ->with('success', 'Welcome back, admin.');
    }

    public function logout(Request $request)
    {
        Session::forget('admin_authenticated');
        Session::forget('admin_email');

        return redirect()->route('home')->with('success', 'Logged out.');
    }
}
