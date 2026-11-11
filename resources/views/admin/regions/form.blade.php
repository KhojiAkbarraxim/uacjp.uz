@extends('admin.layout')

@section('title', $region->exists ? 'Edit region' : 'New region')

@php
    $lines = fn (string $field, string $locale) => old("{$field}_{$locale}", collect($region->{$field} ?? [])->pluck($locale)->implode("\n"));
    $json = fn (string $field) => old($field, json_encode($region->{$field} ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    $secretaries = old('secretaries', $region->relationLoaded('secretaries') ? $region->secretaries->toArray() : []);
@endphp

@section('content')
    <x-admin.page-header :title="$region->exists ? 'Edit region: '.$region->authored('name') : 'New region'">
        @if ($region->exists)
            <a href="{{ route('regions.show', $region->slug) }}" target="_blank" class="btn-secondary">View page ↗</a>
        @endif
    </x-admin.page-header>

    <form action="{{ $region->exists ? route('admin.regions.update', $region) : route('admin.regions.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($region->exists) @method('PUT') @endif

        <fieldset class="admin-fieldset">
            <legend>Basics</legend>
            <x-admin.locale-input name="name" label="Full name" :model="$region" required hint="e.g. UAC Kanto" />
            <x-admin.locale-input name="short_name" label="Short name" :model="$region" required hint="e.g. Kanto" />
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="admin-label" for="slug">URL slug</label>
                    <input id="slug" name="slug" type="text" class="form-input" value="{{ old('slug', $region->slug) }}">
                    <p class="admin-hint">Page address: /regions/<b>slug</b>. Leave empty to generate from the Uzbek name. Changing it breaks old links.</p>
                </div>
                <div>
                    <label class="admin-label" for="sort_order">Sort order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" class="form-input" value="{{ old('sort_order', $region->sort_order) }}">
                </div>
            </div>
            <x-admin.locale-input name="status" label="Status label" :model="$region" hint="e.g. Active Chapter" />
            <x-admin.locale-input name="members_count" label="Members count label" :model="$region" hint="e.g. 150+ members" />
            <x-admin.locale-input name="locations" label="Locations" :model="$region" hint="e.g. Tokyo, Yokohama, Chiba" />
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Texts</legend>
            <x-admin.locale-input name="excerpt" label="Card excerpt" :model="$region" textarea :rows="2" hint="Short line on region cards." />
            <x-admin.locale-input name="summary" label="Summary" :model="$region" textarea />
            <x-admin.locale-input name="about" label="About" :model="$region" textarea :rows="5" />
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Images</legend>
            <div class="grid gap-6 lg:grid-cols-2">
                <x-admin.image-input name="image" label="Card image" :current="$region->image" />
                <x-admin.image-input name="hero_image" label="Page hero image" :current="$region->hero_image" />
            </div>
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Contact</legend>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="admin-label" for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $region->email) }}">
                </div>
                <div>
                    <label class="admin-label" for="phone">Phone</label>
                    <input id="phone" name="phone" type="text" class="form-input" value="{{ old('phone', $region->phone) }}">
                </div>
            </div>
            <x-admin.locale-input name="city" label="City" :model="$region" />
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Secretaries</legend>
            <p class="admin-hint -mt-2">Regional contact people shown on the region card and page. Rows without a name are ignored.</p>
            <div class="space-y-4" data-secretaries>
                @foreach ($secretaries as $i => $s)
                    @include('admin.regions._secretary', ['i' => $i, 's' => $s])
                @endforeach
            </div>
            <button type="button" class="btn-secondary" data-add-secretary>+ Add secretary</button>
            <template id="secretary-template">
                @include('admin.regions._secretary', ['i' => '__INDEX__', 's' => []])
            </template>
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Lists</legend>
            @foreach (['universities' => 'Universities', 'plans' => 'Plans'] as $field => $label)
                <div>
                    <p class="admin-label">{{ $label }}</p>
                    <div class="grid gap-3 lg:grid-cols-3">
                        @foreach (\App\Support\Locales::ORDER as $locale)
                            <label class="block">
                                <span class="admin-lang">{{ $locale }}</span>
                                <textarea name="{{ $field }}_{{ $locale }}" rows="4" class="form-input mt-1">{{ $lines($field, $locale) }}</textarea>
                            </label>
                        @endforeach
                    </div>
                    <p class="admin-hint">One item per line, written in Uzbek. Line 1 in each language belongs together; a line left untranslated reuses the Uzbek text.</p>
                </div>
            @endforeach
        </fieldset>

        <details class="admin-fieldset">
            <summary class="cursor-pointer font-display text-lg text-primary">Advanced: activities &amp; gallery (JSON)</summary>
            @foreach (['activities' => 'Activities — [{"title": {"en","uz","ja"}, "date": {…}, "description": {…}}]', 'gallery' => 'Gallery — [{"title": {"en","uz","ja"}, "tone": "from-primary/90 to-primary/35"}]'] as $field => $hint)
                <div>
                    <label class="admin-label" for="{{ $field }}">{{ ucfirst($field) }}</label>
                    <textarea id="{{ $field }}" name="{{ $field }}" rows="10" class="form-input font-mono text-xs" spellcheck="false">{{ $json($field) }}</textarea>
                    <p class="admin-hint">{{ $hint }}</p>
                </div>
            @endforeach
        </details>

        <x-admin.form-actions :cancel="route('admin.regions.index')" />
    </form>
@endsection

@push('scripts')
    <script>
        (() => {
            const list = document.querySelector('[data-secretaries]');
            const template = document.getElementById('secretary-template');
            let next = {{ count($secretaries) ? max(array_keys($secretaries)) + 1 : 0 }};

            document.querySelector('[data-add-secretary]').addEventListener('click', () => {
                list.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', next++));
            });
            list.addEventListener('click', (e) => {
                if (e.target.matches('[data-remove-secretary]')) e.target.closest('[data-secretary-row]').remove();
            });
        })();
    </script>
@endpush
