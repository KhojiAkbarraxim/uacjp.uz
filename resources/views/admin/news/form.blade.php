@extends('admin.layout')

@section('title', $news->exists ? 'Edit article' : 'New article')

@section('content')
    <x-admin.page-header :title="$news->exists ? 'Edit article' : 'New article'" />

    <form action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($news->exists) @method('PUT') @endif

        <fieldset class="admin-fieldset">
            <legend>Article</legend>
            <x-admin.locale-input name="title" label="Title" :model="$news" required />
            <x-admin.locale-input name="type" label="Category" :model="$news" hint="e.g. Event, Announcement, Research" />
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="admin-label" for="date">Date <span class="text-red-600">*</span></label>
                    <input id="date" name="date" type="date" required class="form-input"
                           value="{{ old('date', $news->date?->format('Y-m-d')) }}">
                </div>
                <div>
                    <label class="admin-label" for="slug">URL slug</label>
                    <input id="slug" name="slug" type="text" class="form-input" value="{{ old('slug', $news->slug) }}">
                    <p class="admin-hint">Page address: /news/<b>slug</b>. Leave empty to generate from the English title.</p>
                </div>
            </div>
            <x-admin.locale-input name="summary" label="Summary" :model="$news" textarea :rows="3" hint="Short text shown on the home page card." />
            <x-admin.locale-input name="body" label="Full text" :model="$news" textarea :rows="10" hint="Shown on the article page. Separate paragraphs with an empty line." />
            <x-admin.image-input name="image" label="Image (optional)" :current="$news->image" />
        </fieldset>

        <x-admin.form-actions :cancel="route('admin.news.index')" />
    </form>
@endsection
