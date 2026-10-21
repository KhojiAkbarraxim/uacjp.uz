<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JoinApplication;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfWeek = $now->copy()->startOfWeek();

        $stats = [
            'total'      => JoinApplication::count(),
            'pending'    => JoinApplication::where('status', 'pending')->count(),
            'approved'   => JoinApplication::where('status', 'approved')->count(),
            'rejected'   => JoinApplication::where('status', 'rejected')->count(),
            'this_week'  => [
                'total'     => JoinApplication::whereBetween('created_at', [$startOfWeek, $now])->count(),
                'pending'   => JoinApplication::where('status', 'pending')->whereBetween('created_at', [$startOfWeek, $now])->count(),
                'approved'  => JoinApplication::where('status', 'approved')->whereBetween('created_at', [$startOfWeek, $now])->count(),
                'rejected'  => JoinApplication::where('status', 'rejected')->whereBetween('created_at', [$startOfWeek, $now])->count(),
            ],
        ];

        $recent = JoinApplication::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}
