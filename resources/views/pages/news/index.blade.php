@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.news_index.hero_eyebrow')"
                :title="ui('pages.news_index.hero_title')"
                :description="ui('pages.news_index.hero_description')"
            />
        </div>
    </section>

    <section class="section-shell pt-0">
        <div class="container-shell space-y-5">
            @forelse ($articles as $news)
                <x-news-card :news="$news" />
            @empty
                <x-i18n :text="ui('pages.news.empty')" tag="p" class="academic-card p-6 text-muted" />
            @endforelse
        </div>
    </section>

    <x-cta
        :title="ui('pages.news_index.cta_title')"
        :description="ui('pages.news_index.cta_description')"
        :primary-label="ui('common.join_uac')"
        primary-href="{{ route('join') }}"
        :secondary-label="ui('pages.news_index.cta_secondary')"
        secondary-href="{{ route('activities') }}"
    />
@endsection
