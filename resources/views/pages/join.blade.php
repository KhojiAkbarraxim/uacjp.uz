@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.join.hero_eyebrow')"
                :title="ui('pages.join.hero_title')"
                :description="ui('pages.join.hero_description')"
            />
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell grid gap-6 lg:grid-cols-2">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-600 p-4 text-green-800 rounded col-span-full">
                    {{ session('success') }}
                </div>
            @endif
            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.join.eligibility_heading')" tag="h2" class="text-3xl" />
                <ul class="mt-5 space-y-3 text-base leading-8 text-muted">
                    @foreach ($join['eligibility'] as $item)
                        <li class="flex gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-secondary"></span>
                            <x-i18n :text="$item" />
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.join.benefits_heading')" tag="h2" class="text-3xl" />
                <ul class="mt-5 space-y-3 text-base leading-8 text-muted">
                    @foreach ($join['benefits'] as $item)
                        <li class="flex gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-accent"></span>
                            <x-i18n :text="$item" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-8 lg:grid-cols-[0.9fr,1.1fr]">
            <div class="space-y-6">
                <x-i18n :text="ui('pages.join.types_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                @foreach ($join['types'] as $type)
                    <div class="academic-card p-6">
                        <x-i18n :text="$type['name']" tag="h3" class="text-2xl" />
                        <x-i18n :text="$type['description']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
                    </div>
                @endforeach
            </div>

            <div class="surface-panel p-8">
                <x-i18n :text="ui('pages.join.form_heading')" tag="h2" class="text-3xl" />
                <x-i18n :text="ui('pages.join.form_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />

                <form class="mt-8 space-y-5" action="{{ route('join.apply') }}" method="post" novalidate>
                    @csrf
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-i18n :text="ui('pages.join.label_full_name')" tag="label" for="join-name" class="mb-2 block text-sm font-medium text-primary" />
                            <input id="join-name" name="name" type="text" class="form-input" required>
                        </div>
                        <div>
                            <x-i18n :text="ui('pages.join.label_email')" tag="label" for="join-email" class="mb-2 block text-sm font-medium text-primary" />
                            <input id="join-email" name="email" type="email" class="form-input" required>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-i18n :text="ui('pages.join.label_membership_type')" tag="label" for="join-type" class="mb-2 block text-sm font-medium text-primary" />
                            <select id="join-type" name="membership_type" class="form-input">
                                @foreach ($join['types'] as $type)
                                    <x-i18n :text="$type['name']" tag="option" />
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-i18n :text="ui('pages.join.label_preferred_region')" tag="label" for="join-region" class="mb-2 block text-sm font-medium text-primary" />
                            <select id="join-region" name="region" class="form-input">
                                @foreach (config('uac.regions') as $region)
                                    <x-i18n :text="$region['name']" tag="option" />
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <x-i18n :text="ui('pages.join.label_affiliation')" tag="label" for="join-affiliation" class="mb-2 block text-sm font-medium text-primary" />
                        <input id="join-affiliation" name="affiliation" type="text" class="form-input">
                    </div>

                    <div>
                        <x-i18n :text="ui('pages.join.label_message')" tag="label" for="join-message" class="mb-2 block text-sm font-medium text-primary" />
                        <textarea id="join-message" name="message" rows="5" class="form-input" placeholder="{{ i18n_text(ui('pages.join.placeholder_message')) }}" data-i18n-en="{{ ui('pages.join.placeholder_message')['en'] }}" data-i18n-uz="{{ ui('pages.join.placeholder_message')['uz'] }}" data-i18n-ja="{{ ui('pages.join.placeholder_message')['ja'] }}" data-i18n-target="placeholder"></textarea>
                    </div>

                    <x-i18n :text="ui('pages.join.submit_button')" tag="button" type="submit" class="btn-primary" />
                </form>
            </div>
        </div>
    </section>
@endsection
