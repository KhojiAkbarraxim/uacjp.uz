<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = [
            'contact_email' => SiteSetting::get('contact.email', 'en') ?? config('uac.contact.email'),
            'social_facebook' => $this->url(SiteSetting::get('social.facebook', 'en')),
            'social_telegram' => $this->url(SiteSetting::get('social.telegram', 'en')),
            'hero_caption' => SiteSetting::dict('home.hero_caption'),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'contact_email' => ['required', 'email', 'max:255'],
            'social_facebook' => ['nullable', 'url', 'max:255'],
            'social_telegram' => ['nullable', 'url', 'max:255'],
            'hero_caption_en' => ['nullable', 'string', 'max:500'],
            'hero_caption_uz' => ['nullable', 'string', 'max:500'],
            'hero_caption_ja' => ['nullable', 'string', 'max:500'],
        ]);

        SiteSetting::set('contact.email', $validated['contact_email'], 'en');
        SiteSetting::set('social.facebook', $validated['social_facebook'] ?? null, 'en');
        SiteSetting::set('social.telegram', $validated['social_telegram'] ?? null, 'en');

        foreach (['en', 'uz', 'ja'] as $locale) {
            SiteSetting::set('home.hero_caption', $validated["hero_caption_{$locale}"] ?? null, $locale);
        }

        return back()->with('success', 'Settings saved.');
    }

    /** The seeder stores "#" as a placeholder link; show it as empty. */
    private function url(?string $value): ?string
    {
        return $value === '#' ? null : $value;
    }
}
