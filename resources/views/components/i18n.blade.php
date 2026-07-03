@props(['text', 'tag' => 'span', 'target' => 'text'])

@php
    $dict = i18n_dict($text);
    $locale = app()->getLocale();
    $value = $dict[$locale] ?? $dict['en'];

    $dataAttributes = [
        'data-i18n-en' => $dict['en'],
        'data-i18n-uz' => $dict['uz'],
        'data-i18n-ja' => $dict['ja'],
    ];

    if ($target !== 'text') {
        $dataAttributes['data-i18n-target'] = $target;
    }
@endphp

@if ($target === 'text')
<{{ $tag }} {{ $attributes->merge($dataAttributes) }}>{{ $value }}</{{ $tag }}>
@else
<{{ $tag }} {{ $attributes->merge(array_merge($dataAttributes, [$target => $value])) }}>
@endif
