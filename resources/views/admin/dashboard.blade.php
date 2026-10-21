@extends('admin.layout')

@section('content')
    @php
        $pageTitle = ['en' => 'Admin Dashboard', 'uz' => 'Admin boshqaruv paneli', 'ja' => '管理ダッシュボード'];
    @endphp

    <section class="container-shell space-y-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <x-i18n :text="ui('admin.dashboard.title')" tag="h2" class="text-3xl font-bold" />
                <x-i18n :text="ui('admin.dashboard.subtitle')" tag="p" class="mt-2 text-muted" />
            </div>
            <a href="{{ route('admin.join.index') }}" class="btn-secondary text-sm px-4 py-2">
                {{ i18n_text(['en' => 'View Applications', 'uz' => 'Arizalarni ko‘rish', 'ja' => '申請を表示']) }}
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-4">
            <div class="academic-card p-6 border-l-4 border-primary">
                <x-i18n :text="ui('admin.dashboard.total')" tag="p" class="text-sm uppercase tracking-[0.15em] text-muted mb-2" />
                <p class="text-3xl font-bold text-primary">{{ number_format($stats['total']) }}</p>
            </div>

            <div class="academic-card p-6 border-l-4 border-yellow-500">
                <x-i18n :text="ui('admin.status.pending')" tag="p" class="text-sm uppercase tracking-[0.15em] text-yellow-700 mb-2" />
                <p class="text-3xl font-bold text-yellow-700">{{ number_format($stats['pending']) }}</p>
                <p class="text-xs text-muted mt-1">@{{ i18n_text(ui('admin.status.pending')) }}: {{ $stats['this_week']['pending'] }}</p>
            </div>

            <div class="academic-card p-6 border-l-4 border-green-500">
                <x-i18n :text="ui('admin.status.approved')" tag="p" class="text-sm uppercase tracking-[0.15em] text-green-700 mb-2" />
                <p class="text-3xl font-bold text-green-700">{{ number_format($stats['approved']) }}</p>
                <p class="text-xs text-muted mt-1">@{{ i18n_text(ui('admin.status.approved')) }}: {{ $stats['this_week']['approved'] }}</p>
            </div>

            <div class="academic-card p-6 border-l-4 border-red-500">
                <x-i18n :text="ui('admin.status.rejected')" tag="p" class="text-sm uppercase tracking-[0.15em] text-red-700 mb-2" />
                <p class="text-3xl font-bold text-red-700">{{ number_format($stats['rejected']) }}</p>
                <p class="text-xs text-muted mt-1">@{{ i18n_text(ui('admin.status.rejected')) }}: {{ $stats['this_week']['rejected'] }}</p>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="academic-card overflow-hidden">
            <div class="p-6 border-b border-muted/20 flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div>
                    <x-i18n :text="ui('admin.dashboard.recent')" tag="h3" class="text-xl font-bold" />
                    <p class="text-sm text-muted">{{ i18n_text(['en' => 'Latest membership applications', 'uz' => 'Oxirgi aʼzolik arizalari', 'ja' => '最新の参加申請']) }}</p>
                </div>
                <a href="{{ route('admin.join.index') }}" class="text-sm font-semibold text-secondary hover:text-primary">
                    {{ i18n_text(['en' => 'See all', 'uz' => 'Hammasini ko‘rish', 'ja' => 'すべて表示']) }} →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-responsive">
                    <thead class="stack-table">
                        <tr class="border-b border-muted/30 text-xs font-semibold uppercase tracking-[0.12em] text-muted">
                            <th class="py-4 px-6">Name</th>
                            <th class="py-4 px-6">Email</th>
                            <th class="py-4 px-6">Type</th>
                            <th class="py-4 px-6">Region</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-muted/10">
                        @forelse ($recent as $app)
                            <tr class="hover:bg-muted/5 transition-colors group">
                                <td class="py-4 px-6 text-sm font-medium">
                                    <a href="{{ route('admin.join.show', $app->id) }}" class="text-primary hover:underline">{{ $app->name }}</a>
                                </td>
                                <td class="py-4 px-6 text-sm text-muted">{{ $app->email }}</td>
                                <td class="py-4 px-6 text-sm">{{ $app->membership_type }}</td>
                                <td class="py-4 px-6 text-sm">{{ $app->region }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold
                                        @if($app->status === 'pending') bg-yellow-50 text-yellow-700
                                        @elseif($app->status === 'approved') bg-green-50 text-green-700
                                        @else bg-red-50 text-red-700 @endif">
                                        {{ i18n_text(ui('admin.status.' . $app->status)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sm text-muted">{{ $app->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-muted">
                                    No applications yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
