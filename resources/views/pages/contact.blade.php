@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.contact.hero_eyebrow')"
                :title="ui('pages.contact.hero_title')"
                :description="ui('pages.contact.hero_description')"
            />
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell grid gap-8 lg:grid-cols-[1.15fr,0.85fr]">
            <div class="surface-panel p-8">
                <x-i18n :text="ui('pages.contact.form_heading')" tag="h2" class="text-3xl" />
                <x-i18n :text="ui('pages.contact.form_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />

                <form class="mt-8 space-y-5" action="#" method="post" novalidate>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-i18n :text="ui('pages.contact.label_full_name')" tag="label" for="name" class="mb-2 block text-sm font-medium text-primary" />
                            <input id="name" name="name" type="text" class="form-input" placeholder="{{ i18n_text(ui('pages.contact.placeholder_full_name')) }}" data-i18n-en="{{ ui('pages.contact.placeholder_full_name')['en'] }}" data-i18n-uz="{{ ui('pages.contact.placeholder_full_name')['uz'] }}" data-i18n-ja="{{ ui('pages.contact.placeholder_full_name')['ja'] }}" data-i18n-target="placeholder" required>
                        </div>
                        <div>
                            <x-i18n :text="ui('pages.contact.label_email')" tag="label" for="email" class="mb-2 block text-sm font-medium text-primary" />
                            <input id="email" name="email" type="email" class="form-input" placeholder="{{ i18n_text(ui('pages.contact.placeholder_email')) }}" data-i18n-en="{{ ui('pages.contact.placeholder_email')['en'] }}" data-i18n-uz="{{ ui('pages.contact.placeholder_email')['uz'] }}" data-i18n-ja="{{ ui('pages.contact.placeholder_email')['ja'] }}" data-i18n-target="placeholder" required>
                        </div>
                    </div>

                    <div>
                        <x-i18n :text="ui('pages.contact.label_topic')" tag="label" for="topic" class="mb-2 block text-sm font-medium text-primary" />
                        <select id="topic" name="topic" class="form-input">
                            <x-i18n :text="ui('pages.contact.topic_general')" tag="option" />
                            <x-i18n :text="ui('pages.contact.topic_membership')" tag="option" />
                            <x-i18n :text="ui('pages.contact.topic_regional')" tag="option" />
                            <x-i18n :text="ui('pages.contact.topic_partnership')" tag="option" />
                            <x-i18n :text="ui('pages.contact.topic_event')" tag="option" />
                        </select>
                    </div>

                    <div>
                        <x-i18n :text="ui('pages.contact.label_message')" tag="label" for="message" class="mb-2 block text-sm font-medium text-primary" />
                        <textarea id="message" name="message" rows="6" class="form-input" placeholder="{{ i18n_text(ui('pages.contact.placeholder_message')) }}" data-i18n-en="{{ ui('pages.contact.placeholder_message')['en'] }}" data-i18n-uz="{{ ui('pages.contact.placeholder_message')['uz'] }}" data-i18n-ja="{{ ui('pages.contact.placeholder_message')['ja'] }}" data-i18n-target="placeholder" required></textarea>
                    </div>

                    <x-i18n :text="ui('pages.contact.submit_button')" tag="button" type="submit" class="btn-primary" />
                </form>
            </div>

            <div class="space-y-6">
                <div class="academic-card p-8">
                    <x-i18n :text="ui('pages.contact.general_contact_heading')" tag="h2" class="text-2xl" />
                    <p class="mt-4 text-base leading-8 text-muted">{{ $contact['email'] }}</p>
                    <x-i18n :text="$contact['response']" tag="p" class="mt-2 text-sm text-muted" />
                </div>

                <div class="academic-card p-8">
                    <x-i18n :text="ui('pages.contact.regional_contacts_heading')" tag="h2" class="text-2xl" />
                    <div class="mt-5 space-y-4">
                        @foreach ($contact['regional_contacts'] as $regionalContact)
                            <div class="flex items-center justify-between gap-4 rounded-2xl border border-line bg-slate-50 px-4 py-3">
                                <x-i18n :text="$regionalContact['region']" tag="span" class="font-medium text-primary" />
                                <span class="text-sm text-muted">{{ $regionalContact['email'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="academic-card p-8">
                    <x-i18n :text="ui('pages.contact.social_media_heading')" tag="h2" class="text-2xl" />
                    <div class="mt-5 flex flex-wrap gap-3">
                        @foreach ($contact['socials'] as $social)
                            <a href="{{ $social['url'] }}" class="btn-secondary">{{ $social['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-10 lg:grid-cols-[0.8fr,1.2fr]">
            <x-section-title
                :eyebrow="ui('pages.contact.faq_eyebrow')"
                :title="ui('pages.contact.faq_title')"
                :description="ui('pages.contact.faq_description')"
            />

            <div class="space-y-4">
                @foreach ($faqs as $faq)
                    <div class="academic-card overflow-hidden">
                        <button
                            type="button"
                            class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                            aria-controls="faq-answer-{{ $loop->index }}"
                            data-faq-button
                        >
                            <x-i18n :text="$faq['question']" tag="span" class="text-lg font-semibold text-primary" />
                            <span class="text-2xl text-secondary" data-faq-indicator>{{ $loop->first ? '−' : '+' }}</span>
                        </button>
                        <div id="faq-answer-{{ $loop->index }}" class="{{ $loop->first ? '' : 'hidden' }} border-t border-line px-6 py-5 text-sm leading-7 text-muted">
                            <x-i18n :text="$faq['answer']" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
