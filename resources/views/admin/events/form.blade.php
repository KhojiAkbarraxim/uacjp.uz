@extends('admin.layout')

@section('title', $event->exists ? 'Edit event' : 'New event')

@section('content')
    <x-admin.page-header :title="$event->exists ? 'Edit event' : 'New event'" />

    <form action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($event->exists) @method('PUT') @endif

        <fieldset class="admin-fieldset">
            <legend>Details</legend>
            <x-admin.locale-input name="title" label="Title" :model="$event" required />
            <x-admin.locale-input name="type" label="Type" :model="$event" required hint="e.g. Symposium, Meetup, Workshop" />
            <x-admin.locale-input name="location" label="Location" :model="$event" required />
            <div class="max-w-xs">
                <label class="admin-label" for="date">Date <span class="text-red-600">*</span></label>
                <input id="date" name="date" type="date" required class="form-input"
                       value="{{ old('date', $event->date?->format('Y-m-d')) }}">
                <p class="admin-hint">Events before today are shown as past automatically.</p>
            </div>
            <x-admin.image-input name="image" label="Image (optional)" :current="$event->image" />
        </fieldset>

        <x-admin.form-actions :cancel="route('admin.events.index')" />
    </form>
@endsection
