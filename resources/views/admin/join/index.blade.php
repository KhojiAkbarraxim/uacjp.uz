@extends('admin.layout')

@section('content')
    @php
        $pageTitle = ['en' => 'Join Applications', 'uz' => 'Arizalar', 'ja' => '参加申請'];
    @endphp

    <section class="container-shell space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <x-i18n :text="ui('admin.join.title')" tag="h2" class="text-3xl" />
                <x-i18n :text="ui('admin.join.subtitle')" tag="p" class="mt-2 text-muted" />
            </div>
            <div class="flex gap-2">
                <form action="{{ route('admin.logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="btn-secondary text-sm">
                        {{ i18n_text(ui('admin.actions.logout')) }}
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-600 p-4 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="academic-card p-6">
            <form action="{{ route('admin.join.index') }}" method="GET" class="grid gap-4 sm:grid-cols-4 lg:grid-cols-6">
                <div>
                    <label class="block text-sm font-medium text-primary mb-1">{{ i18n_text(['en' => 'Search', 'uz' => 'Qidirish', 'ja' => '検索']) }}</label>
                    <input name="search" type="text" class="form-input w-full" placeholder="{{ i18n_text(['en' => 'Name or email', 'uz' => 'Ism yoki email', 'ja' => '名前またはメール']) }}" value="{{ old('search', request('search')) }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1">{{ i18n_text(['en' => 'Status', 'uz' => 'Holat', 'ja' => 'ステータス']) }}</label>
                    <select name="status" class="form-input w-full">
                        <option value="">{{ i18n_text(['en' => 'All statuses', 'uz' => 'Barcha holatlar', 'ja' => 'すべてのステータス']) }}</option>
                        @foreach (ui('admin.status') as $key => $label)
                            <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ i18n_text($label) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1">{{ i18n_text(['en' => 'Region', 'uz' => 'Mintaqa', 'ja' => '地域']) }}</label>
                    <select name="region" class="form-input w-full">
                        <option value="">{{ i18n_text(['en' => 'All regions', 'uz' => 'Barcha mintaqalar', 'ja' => 'すべての地域']) }}</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region }}" {{ request('region') === $region ? 'selected' : '' }}>{{ $region }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-1">{{ i18n_text(['en' => 'Membership type', 'uz' => 'Aʼzo turi', 'ja' => '会員種別']) }}</label>
                    <select name="membership_type" class="form-input w-full">
                        <option value="">{{ i18n_text(['en' => 'All types', 'uz' => 'Barcha turlar', 'ja' => 'すべての種類']) }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ request('membership_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="btn-primary w-full">
                        {{ i18n_text(['en' => 'Filter', 'uz' => 'Filtr', 'ja' => 'フィルター']) }}
                    </button>
                </div>

                @if (request()->hasAny(['search', 'status', 'region', 'membership_type']))
                    <a href="{{ route('admin.join.index') }}" class="text-sm text-secondary hover:text-primary underline">
                        {{ i18n_text(['en' => 'Clear filters', 'uz' => 'Filtrlarni tozalash', 'ja' => 'フィルターをクリア']) }}
                    </a>
                @endif
            </form>
        </div>

        <div class="academic-card overflow-hidden">
            <table class="w-full text-left border-collapse table-responsive">
                <thead class="stack-table">
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
                        <tr class="hover:bg-muted/5 transition-colors group">
                            <td class="py-4 px-6 text-sm text-muted">{{ $loop->iteration + ($applications->currentPage() - 1) * 15 }}</td>
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
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="{{ route('admin.join.show', $app->id) }}" class="text-xs bg-muted/50 text-muted border border-muted/20 rounded px-2 py-1 hover:bg-primary hover:text-white hover:border-primary transition-colors">
                                    {{ i18n_text(['en' => 'View', 'uz' => 'Ko‘rish', 'ja' => '表示']) }}
                                </a>
                                @if ($app->status === 'pending')
                                    <form action="{{ route('admin.join.update', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="text-xs bg-green-50 text-green-700 px-2 py-1 rounded border border-green-200 hover:bg-green-100 transition">
                                            {{ i18n_text(ui('admin.actions.approve')) }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.join.update', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="text-xs bg-red-50 text-red-700 px-2 py-1 rounded border border-red-200 hover:bg-red-100 transition">
                                            {{ i18n_text(ui('admin.actions.reject')) }}
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
                                No applications match your filters.
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
    </section>
@endsection
