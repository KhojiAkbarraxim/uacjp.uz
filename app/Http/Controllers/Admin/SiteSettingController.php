<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use App\Support\Locales;

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

    public function update(SiteSettingRequest $request)
    {
        $validated = $request->validated();

        SiteSetting::set('contact.email', $validated['contact_email'], 'en');
        SiteSetting::set('social.facebook', $validated['social_facebook'] ?? null, 'en');
        SiteSetting::set('social.telegram', $validated['social_telegram'] ?? null, 'en');

        foreach (Locales::ORDER as $locale) {
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
