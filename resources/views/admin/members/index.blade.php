@extends('admin.layout')

@section('title', 'Members')

@section('content')
    <x-admin.page-header title="Members" subtitle="The public member directory, grouped into Executive, Ambassador and Staff.">
        <a href="{{ route('admin.members.create') }}" class="btn-primary">+ New member</a>
    </x-admin.page-header>

    <form method="GET" class="flex flex-wrap gap-2">
        <input name="search" type="search" value="{{ request('search') }}" placeholder="Name or affiliation…" class="form-input max-w-xs">
        <select name="type" class="form-input max-w-[12rem]">
            <option value="">All types</option>
            @foreach (\App\Http\Controllers\Admin\MemberController::TYPES as $type)
                <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
            @endforeach
        </select>
        <button class="btn-secondary">Filter</button>
        @if (request()->hasAny(['search', 'type']))
            <a href="{{ route('admin.members.index') }}" class="self-center text-sm text-secondary underline">Clear</a>
        @endif
    </form>

    <div class="admin-card overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Affiliation</th>
                    <th>Field</th>
                    <th>Region</th>
                    <th>Type</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                    <tr>
                        <td class="text-muted">{{ $member->sort_order }}</td>
                        <td class="font-medium text-primary">{{ $member->name }}</td>
                        <td>{{ $member->role_en }}</td>
                        <td>{{ $member->affiliation_en }}</td>
                        <td>{{ $member->field_en }}</td>
                        <td>{{ $member->region_en }}</td>
                        <td><span class="chip {{ $member->type === 'Executive' ? 'bg-secondary-soft text-secondary' : '' }}">{{ $member->type }}</span></td>
                        <td class="whitespace-nowrap text-right space-x-1">
                            <a href="{{ route('admin.members.edit', $member) }}" class="btn-small">Edit</a>
                            <x-admin.delete-button :action="route('admin.members.destroy', $member)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="py-10 text-center text-muted">No members found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $members->links() }}</div>
@endsection
