@extends('admin.layout')

@section('title', $member->exists ? 'Edit member' : 'New member')

@section('content')
    <x-admin.page-header :title="$member->exists ? 'Edit member' : 'New member'" />

    <form action="{{ $member->exists ? route('admin.members.update', $member) : route('admin.members.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($member->exists) @method('PUT') @endif

        <fieldset class="admin-fieldset">
            <legend>Profile</legend>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="sm:col-span-1">
                    <label class="admin-label" for="name">Full name <span class="text-red-600">*</span></label>
                    <input id="name" name="name" type="text" required class="form-input" value="{{ old('name', $member->name) }}">
                </div>
                <div>
                    <label class="admin-label" for="type">Type <span class="text-red-600">*</span></label>
                    <select id="type" name="type" class="form-input">
                        @foreach (\App\Http\Controllers\Admin\MemberController::TYPES as $type)
                            <option value="{{ $type }}" @selected(old('type', $member->type) === $type)>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="admin-label" for="sort_order">Sort order</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" class="form-input" value="{{ old('sort_order', $member->sort_order) }}">
                    <p class="admin-hint">Lower numbers appear first.</p>
                </div>
            </div>
            <x-admin.locale-input name="role" label="Role" :model="$member" hint="e.g. Ph.D. Candidate, Research Associate" />
            <x-admin.locale-input name="affiliation" label="Affiliation" :model="$member" hint="University or organization" />
            <x-admin.image-input name="photo" label="Photo (optional)" :current="$member->photo" />
            <x-admin.locale-input name="bio" label="Biography" :model="$member" textarea :rows="6" hint="Optional. Shown behind a “Read more” toggle on the Members page. Separate paragraphs with an empty line." />
        </fieldset>

        <fieldset class="admin-fieldset">
            <legend>Directory filters</legend>
            <x-admin.locale-input name="field" label="Academic field" :model="$member" />
            <x-admin.locale-input name="region" label="Region" :model="$member" />
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="admin-label" for="field_slug">Field filter key</label>
                    <input id="field_slug" name="field_slug" type="text" class="form-input" value="{{ old('field_slug', $member->field_slug) }}">
                    <p class="admin-hint">Members with the same key are grouped in the field filter. Leave empty to generate from the Uzbek field.</p>
                </div>
                <div>
                    <label class="admin-label" for="region_slug">Region filter key</label>
                    <input id="region_slug" name="region_slug" type="text" class="form-input" value="{{ old('region_slug', $member->region_slug) }}">
                    <p class="admin-hint">Leave empty to generate from the Uzbek region.</p>
                </div>
            </div>
        </fieldset>

        <x-admin.form-actions :cancel="route('admin.members.index')" />
    </form>
@endsection
