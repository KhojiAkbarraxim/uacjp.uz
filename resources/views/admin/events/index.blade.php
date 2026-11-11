@extends('admin.layout')

@section('title', 'Events')

@section('content')
    <x-admin.page-header title="Events" subtitle="Shown in the home page calendar and on the Activities page.">
        <a href="{{ route('admin.events.create') }}" class="btn-primary">+ New event</a>
    </x-admin.page-header>

    <div class="flex flex-wrap gap-2">
        @foreach (['' => 'All', 'upcoming' => 'Upcoming', 'past' => 'Past'] as $value => $label)
            <a href="{{ route('admin.events.index', array_filter(['when' => $value])) }}"
               class="filter-button {{ request('when', '') === $value ? 'is-active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    @php $isPast = $event->date->lt(today()); @endphp
                    <tr class="{{ $isPast ? 'text-muted' : '' }}">
                        <td class="whitespace-nowrap">
                            {{ $event->date->format('M d, Y') }}
                            @unless ($isPast)<span class="ml-1 chip bg-secondary-soft text-secondary">Upcoming</span>@endunless
                        </td>
                        <td class="font-medium text-primary">{{ $event->authored('title') }}</td>
                        <td>{{ $event->authored('type') }}</td>
                        <td>{{ $event->authored('location') }}</td>
                        <td class="whitespace-nowrap text-right space-x-1">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn-small">Edit</a>
                            <x-admin.delete-button :action="route('admin.events.destroy', $event)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-10 text-center text-muted">No events yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $events->links() }}</div>
@endsection
