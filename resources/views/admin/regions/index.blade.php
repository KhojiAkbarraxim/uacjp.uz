@extends('admin.layout')

@section('title', 'Regions')

@section('content')
    <x-admin.page-header title="Regions" subtitle="Regional chapters, their pages and secretaries. The first four appear on the home page.">
        <a href="{{ route('admin.regions.create') }}" class="btn-primary">+ New region</a>
    </x-admin.page-header>

    <div class="admin-card overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Secretaries</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($regions as $region)
                    <tr>
                        <td class="text-muted">{{ $region->sort_order }}</td>
                        <td>@if ($region->image)<img src="{{ asset($region->image) }}" alt="" class="admin-thumb">@endif</td>
                        <td class="whitespace-nowrap">
                            <p class="font-medium text-primary">{{ $region->name_en }}</p>
                            <p class="text-xs text-muted">/regions/{{ $region->slug }}</p>
                        </td>
                        <td>{{ $region->status_en }}</td>
                        <td>{{ $region->secretaries_count }}</td>
                        <td class="whitespace-nowrap text-right space-x-1">
                            <a href="{{ route('regions.show', $region->slug) }}" target="_blank" class="btn-small">View</a>
                            <a href="{{ route('admin.regions.edit', $region) }}" class="btn-small">Edit</a>
                            <x-admin.delete-button :action="route('admin.regions.destroy', $region)"
                                confirm="Delete this region and its secretaries? This cannot be undone." />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-10 text-center text-muted">No regions yet. Run <code>php artisan static:seed</code> to import the current site content.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $regions->links() }}</div>
@endsection
