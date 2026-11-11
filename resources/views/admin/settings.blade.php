@extends('admin.layout')

@section('title', 'Settings')

@section('content')
    <x-admin.page-header title="Site settings" subtitle="Contact details and social links used across the public site." />

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <fieldset class="admin-fieldset">
            <legend>Contact &amp; social</legend>
            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <label class="admin-label" for="contact_email">Contact email <span class="text-red-600">*</span></label>
                    <input id="contact_email" name="contact_email" type="email" required class="form-input"
                           value="{{ old('contact_email', $settings['contact_email']) }}">
                    <p class="admin-hint">Shown in the footer and on the Contact page.</p>
                </div>
                <div>
                    <label class="admin-label" for="social_facebook">Facebook URL</label>
                    <input id="social_facebook" name="social_facebook" type="url" class="form-input" placeholder="https://facebook.com/…"
                           value="{{ old('social_facebook', $settings['social_facebook']) }}">
                </div>
                <div>
                    <label class="admin-label" for="social_telegram">Telegram URL</label>
                    <input id="social_telegram" name="social_telegram" type="url" class="form-input" placeholder="https://t.me/…"
                           value="{{ old('social_telegram', $settings['social_telegram']) }}">
                </div>
            </div>
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Home page</legend>
            <div>
                <p class="admin-label">Hero image caption</p>
                <div class="grid gap-3 lg:grid-cols-3">
                    @foreach (\App\Support\Locales::ORDER as $locale)
                        <label class="block">
                            <span class="admin-lang">{{ $locale }}</span>
                            <textarea name="hero_caption_{{ $locale }}" rows="3" class="form-input mt-1">{{ old("hero_caption_{$locale}", $settings['hero_caption'][$locale] ?? '') }}</textarea>
                        </label>
                    @endforeach
                </div>
                <p class="admin-hint">Leave all three empty to use the default caption.</p>
            </div>
        </fieldset>

        <x-admin.form-actions :cancel="route('admin.dashboard')" />
    </form>
@endsection
