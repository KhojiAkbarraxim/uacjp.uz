<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::latest()->paginate(20);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'name_uz' => ['nullable', 'string', 'max:255'],
            'name_ja' => ['nullable', 'string', 'max:255'],
            'short_name_en' => ['required', 'string', 'max:255'],
            'short_name_uz' => ['nullable', 'string', 'max:255'],
            'short_name_ja' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Inactive'],
            'members_count' => ['nullable', 'string', 'max:255'],
            'summary_en' => ['nullable', 'string'],
            'summary_uz' => ['nullable', 'string'],
            'summary_ja' => ['nullable', 'string'],
            'excerpt_en' => ['nullable', 'string'],
            'excerpt_uz' => ['nullable', 'string'],
            'excerpt_ja' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
            'city_en' => ['nullable', 'string', 'max:255'],
            'city_uz' => ['nullable', 'string', 'max:255'],
            'city_ja' => ['nullable', 'string', 'max:255'],
        ]);

        $region = Region::create($validated);

        // Handle secretaries
        if ($request->filled('secretary_name')) {
            $region->secretaries()->createMany(
                array_filter([
                    ['name' => $request->secretary_name, 'role_en' => $request->secretary_role_en, 'email' => $request->secretary_email, 'phone' => $request->secretary_phone],
                ])
            );
        }

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$region->name_en}' created.");
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_uz' => ['nullable', 'string', 'max:255'],
            'name_ja' => ['nullable', 'string', 'max:255'],
            'short_name_en' => ['required', 'string', 'max:255'],
            'short_name_uz' => ['nullable', 'string', 'max:255'],
            'short_name_ja' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Inactive'],
            'members_count' => ['nullable', 'string', 'max:255'],
            'summary_en' => ['nullable', 'string'],
            'summary_uz' => ['nullable', 'string'],
            'summary_ja' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
        ]);

        $region->update($validated);

        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$region->name_en}' updated.");
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')
            ->with('success', "Region '{$region->name_en}' deleted.");
    }
}
