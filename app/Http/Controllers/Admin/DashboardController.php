<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\JoinApplication;
use App\Models\Member;
use App\Models\News;
use App\Models\Region;
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

        $content = [
            ['label' => 'Regions', 'count' => Region::count(), 'route' => 'admin.regions.index'],
            ['label' => 'Members', 'count' => Member::count(), 'route' => 'admin.members.index'],
            ['label' => 'Upcoming events', 'count' => Event::whereDate('date', '>=', today())->count(), 'route' => 'admin.events.index'],
            ['label' => 'News', 'count' => News::count(), 'route' => 'admin.news.index'],
        ];

        return view('admin.dashboard', compact('stats', 'recent', 'content'));
    }
}
