@extends('admin.layout')

@section('title', 'News')

@section('content')
    <x-admin.page-header title="News" subtitle="The three most recent items appear on the home page.">
        <a href="{{ route('admin.news.create') }}" class="btn-primary">+ New article</a>
    </x-admin.page-header>

    <form method="GET" class="flex max-w-md gap-2">
        <input name="search" type="search" value="{{ request('search') }}" placeholder="Search titles…" class="form-input">
        <button class="btn-secondary">Search</button>
    </form>

    <div class="admin-card overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th></th>
                    <th>Title</th>
                    <th>Type</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $item)
                    <tr>
                        <td class="whitespace-nowrap">{{ $item->date->format('M d, Y') }}</td>
                        <td>@if ($item->image)<img src="{{ asset($item->image) }}" alt="" class="admin-thumb">@endif</td>
                        <td class="font-medium text-primary">{{ $item->authored('title') }}</td>
                        <td>{{ $item->authored('type') }}</td>
                        <td class="whitespace-nowrap text-right space-x-1">
                            @if ($item->slug)
                                <a href="{{ route('news.show', $item->slug) }}" target="_blank" class="btn-small">View</a>
                            @endif
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn-small">Edit</a>
                            <x-admin.delete-button :action="route('admin.news.destroy', $item)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-10 text-center text-muted">No news yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $news->links() }}</div>
@endsection
