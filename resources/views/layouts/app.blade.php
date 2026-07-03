<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $locale = app()->getLocale();
        $suffix = ' | '.$site['short_name'];
        $titleDict = collect(i18n_dict($pageTitle ?? $site['short_name']))->map(fn ($value) => isset($pageTitle) ? $value.$suffix : $value)->all();
        $descriptionDict = i18n_dict($metaDescription ?? $site['description']);
    @endphp
    <title data-i18n-en="{{ $titleDict['en'] }}" data-i18n-uz="{{ $titleDict['uz'] }}" data-i18n-ja="{{ $titleDict['ja'] }}">{{ $titleDict[$locale] }}</title>
    <meta name="description" content="{{ $descriptionDict[$locale] }}" data-i18n-target="content" data-i18n-en="{{ $descriptionDict['en'] }}" data-i18n-uz="{{ $descriptionDict['uz'] }}" data-i18n-ja="{{ $descriptionDict['ja'] }}">
    <meta property="og:title" content="{{ $titleDict[$locale] }}" data-i18n-target="content" data-i18n-en="{{ $titleDict['en'] }}" data-i18n-uz="{{ $titleDict['uz'] }}" data-i18n-ja="{{ $titleDict['ja'] }}">
    <meta property="og:description" content="{{ $descriptionDict[$locale] }}" data-i18n-target="content" data-i18n-en="{{ $descriptionDict['en'] }}" data-i18n-uz="{{ $descriptionDict['uz'] }}" data-i18n-ja="{{ $descriptionDict['ja'] }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $site['name'] }}">
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <div class="page-loader" data-page-loader></div>

    @include('partials.navbar')

    <div class="relative overflow-hidden pt-24">
        <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[32rem] bg-[radial-gradient(circle_at_top_left,rgba(27,109,36,0.08),transparent_28rem)]"></div>
        @yield('content')
    </div>

    @include('partials.footer')
</body>
</html>
