@extends('layouts.app')

@section('content')
    @php
        $pageTitle = ['en' => 'Join Applications', 'uz' => 'Arizalar', 'ja' => '参加申請'];
        $metaDescription = ['en' => 'Review and manage UAC Japan membership applications.', 'uz' => 'UAC Japan aʼzolik arizalarini koʻrib chiqish va boshqarish.', 'ja' => 'UAC Japanの参加申請を確認・管理します。'];
    @endphp

    <section class="section-shell">
        <div class="container-shell space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <x-i18n :text="ui('admin.join.title')" tag="h2" class="text-3xl" />
                    <x-i18n :text="ui('admin.join.subtitle')" tag="p" class="mt-2 text-muted" />
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('admin.logout') }}" method="post" class="inline">
                        @csrf
                        <button type="submit" class="btn-secondary text-sm">
                            {{ i18n_text(['en' => 'Logout', 'uz' => 'Chiqqan', 'ja' => 'ログアウト']) }}
                        </button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-600 p-4 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="academic-card overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-muted/30 text-sm font-semibold uppercase tracking-[0.1em] text-muted">
                            <th class="py-4 px-6">#</th>
                            <th class="py-4 px-6">Name</th>
                            <th class="py-4 px-6">Email</th>
                            <th class="py-4 px-6">Type</th>
                            <th class="py-4 px-6">Region</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-muted/10">
                        @forelse ($applications as $app)
                            <tr class="hover:bg-muted/5 transition-colors">
                                <td class="py-4 px-6 text-sm text-muted">{{ $loop->iteration + ($applications->currentPage() - 1) * 15 }}</td>
                                <td class="py-4 px-6 text-sm font-medium">{{ $app->name }}</td>
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
                                <td class="py-4 px-6 text-right space-x-2">
                                    @if ($app->status === 'pending')
                                        <form action="{{ route('admin.join.update', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-xs bg-green-50 text-green-700 px-2 py-1 rounded border border-green-200 hover:bg-green-100 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.join.update', $app->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-xs bg-red-50 text-red-700 px-2 py-1 rounded border border-red-200 hover:bg-red-100 transition">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-muted">{{ i18n_text(ui('admin.status.' . $app->status)) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-10 text-center text-muted">
                                    No applications yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($applications->count())
                    <div class="px-6 py-4 border-t border-muted/30">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
