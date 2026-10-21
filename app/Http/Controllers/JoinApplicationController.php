<?php

namespace App\Http\Controllers;

use App\Models\JoinApplication;
use Illuminate\Http\Request;

class JoinApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'membership_type' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'affiliation' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        JoinApplication::create([
            ...$validated,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Arizangiz qabul qilindi! Tez orada siz bilan bogʻlanamiz.');
    }

    public function index()
    {
        $applications = JoinApplication::latest()->paginate(15);

        return view('admin.join.index', compact('applications'));
    }
}
