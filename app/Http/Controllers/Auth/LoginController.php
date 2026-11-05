<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! $this->credentialsMatch($validated['email'], $validated['password'])) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_email', $validated['email']);

        return redirect()->intended(route('admin.dashboard'))
            ->with('success', 'Welcome back, admin.');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function credentialsMatch(string $email, string $password): bool
    {
        $adminEmail = (string) config('admin.email');
        $adminPassword = (string) config('admin.password');

        if ($adminEmail === '' || $adminPassword === '' || ! hash_equals(strtolower($adminEmail), strtolower($email))) {
            return false;
        }

        if (Hash::info($adminPassword)['algo'] !== null) {
            return Hash::check($password, $adminPassword);
        }

        return hash_equals($adminPassword, $password);
    }
}
