@props([
    'name',
    'label',
    'model' => null,
    'textarea' => false,
    'rows' => 3,
    'required' => false,
    'hint' => null,
])

@php
    use App\Services\Translator;
    use App\Support\Locales;

    $targets = array_values(array_diff(Locales::ORDER, [Locales::SOURCE]));
    $targetLabel = strtoupper(implode(', ', $targets));
@endphp

<div data-locale-input>
    <div class="flex items-center justify-between gap-3">
        <p class="admin-label">{{ $label }} @if ($required)<span class="text-red-600">*</span>@endif</p>
        @if (Translator::configured())
            <button type="button" class="btn-small mb-1" data-translate data-source="{{ Locales::SOURCE }}" data-targets="{{ implode(',', $targets) }}"
                title="Fill empty {{ $targetLabel }} fields from the {{ strtoupper(Locales::SOURCE) }} text">
                Translate {{ strtoupper(Locales::SOURCE) }} → {{ $targetLabel }}
            </button>
        @endif
    </div>
    <div class="grid gap-3 {{ $textarea ? 'lg:grid-cols-3' : 'sm:grid-cols-3' }}">
        {{-- Uzbek first: it is the language the content is written in. English
             and Japanese are filled in afterwards by translating. --}}
        @foreach (Locales::ORDER as $locale)
            @php
                $field = "{$name}_{$locale}";
                $value = old($field, $model?->{$field});
            @endphp
            <label class="block">
                <span class="admin-lang">{{ $locale }}</span>
                @if ($textarea)
                    <textarea name="{{ $field }}" data-locale="{{ $locale }}" rows="{{ $rows }}" class="form-input mt-1 @error($field) border-red-500 @enderror" @required($required && $locale === Locales::SOURCE)>{{ $value }}</textarea>
                @else
                    <input name="{{ $field }}" data-locale="{{ $locale }}" type="text" value="{{ $value }}" class="form-input mt-1 @error($field) border-red-500 @enderror" @required($required && $locale === Locales::SOURCE)>
                @endif
            </label>
        @endforeach
    </div>
    @if ($hint)
        <p class="admin-hint">{{ $hint }}</p>
    @endif
    <p class="admin-hint hidden" data-translate-status role="status"></p>
</div>
