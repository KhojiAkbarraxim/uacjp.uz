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
    use App\Support\Locales;
@endphp

<div>
    <p class="admin-label">{{ $label }} @if ($required)<span class="text-red-600">*</span>@endif</p>
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
                    <textarea name="{{ $field }}" rows="{{ $rows }}" class="form-input mt-1 @error($field) border-red-500 @enderror" @required($required && $locale === Locales::SOURCE)>{{ $value }}</textarea>
                @else
                    <input name="{{ $field }}" type="text" value="{{ $value }}" class="form-input mt-1 @error($field) border-red-500 @enderror" @required($required && $locale === Locales::SOURCE)>
                @endif
            </label>
        @endforeach
    </div>
    @if ($hint)
        <p class="admin-hint">{{ $hint }}</p>
    @endif
</div>
