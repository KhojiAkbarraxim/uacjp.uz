<?php

namespace App\Http\Controllers;

use App\Models\JoinApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JoinApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255'],
            'membership_type'=> ['required', 'string', 'max:255'],
            'region'         => ['required', 'string', 'max:255'],
            'affiliation'    => ['nullable', 'string', 'max:255'],
            'message'        => ['nullable', 'string'],
        ]);

        $application = JoinApplication::create([
            ...$validated,
            'status' => 'pending',
        ]);

        Mail::to(config('admin.notification_email', env('ADMIN_NOTIFICATION_EMAIL', 'admin@uacjp.uz')))
            ->send(new JoinApplicationReceived($application));

        return back()->with('success', 'Arizangiz qabul qilindi! Tez orada siz bilan bog‘lanamiz.');
    }

    public function index(Request $request)
    {
        $query = JoinApplication::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('region')) {
            $query->where('region', 'like', '%'.$request->region.'%');
        }

        if ($request->filled('membership_type')) {
            $query->where('membership_type', 'like', '%'.$request->membership_type.'%');
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $applications = $query->latest()->paginate(15)->appends($request->only(['status', 'region', 'membership_type', 'search']));

        $regions = JoinApplication::distinct()->pluck('region');
        $types = JoinApplication::distinct()->pluck('membership_type');

        return view('admin.join.index', compact('applications', 'regions', 'types'));
    }

    public function updateStatus(Request $request, JoinApplication $application)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', "Status updated to {$request->status}.");
    }
}
