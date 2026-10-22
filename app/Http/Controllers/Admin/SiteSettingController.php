<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings.*.key' => ['required', 'string'],
            'settings.*.value_en' => ['nullable', 'string'],
            'settings.*.value_uz' => ['nullable', 'string'],
            'settings.*.value_ja' => ['nullable', 'string'],
            'settings.*.meta' => ['nullable', 'json'],
        ]);

        collect($validated['settings'])->each(function ($setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], [
                'value_en' => $setting['value_en'],
                'value_uz' => $setting['value_uz'],
                'value_ja' => $setting['value_ja'],
                'meta' => json_decode($setting['meta'] ?? 'null', true),
            ]);
        });

        return back()->with('success', 'Settings saved.');
    }
}
