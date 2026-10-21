@extends('admin.layout')

@section('content')
    @php
        $pageTitle = ['en' => 'Application #{{ $application->id }}', 'uz' => 'Ariza #{{ $application->id }}', 'ja' => '申請 #{{ $application->id }}'];
        $metaDescription = ['en' => 'View details of membership application #{{ $application->id }}.', 'uz' => 'Aʼzolik arizasi #{{ $application->id }} tafsilotlari.', 'ja' => '参加申請 #{{ $application->id }} の詳細。'];
    @endphp

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Application info card -->
        <div class="lg:w-3/5 space-y-6">
            <div class="academic-card p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-primary">{{ $application->name }}</h2>
                        <p class="text-sm text-muted">{{ $application->membership_type }} • {{ $application->region }}</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold
                        @if($application->status === 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                        @elseif($application->status === 'approved') bg-green-50 text-green-700 border border-green-200
                        @else bg-red-50 text-red-700 border border-red-200 @endif">
                        {{ i18n_text(ui('admin.status.' . $application->status)) }}
                    </span>
                </div>

                <dl class="space-y-4 text-sm">
                    <div class="flex items-start gap-4 border-b border-muted/10 pb-2">
                        <dt class="w-24 text-muted font-medium">{{ i18n_text(['en' => 'Email', 'uz' => 'Email', 'ja' => 'メール']) }}</dt>
                        <dd class="flex-1 text-primary">{{ $application->email }}</dd>
                    </div>
                    <div class="flex items-start gap-4 border-b border-muted/10 pb-2">
                        <dt class="w-24 text-muted font-medium">{{ i18n_text(['en' => 'Membership type', 'uz' => 'Aʼzo turi', 'ja' => '会員種別']) }}</dt>
                        <dd class="flex-1">{{ $application->membership_type }}</dd>
                    </div>
                    <div class="flex items-start gap-4 border-b border-muted/10 pb-2">
                        <dt class="w-24 text-muted font-medium">{{ i18n_text(['en' => 'Region', 'uz' => 'Mintaqa', 'ja' => '地域']) }}</dt>
                        <dd class="flex-1">{{ $application->region }}</dd>
                    </div>
                    <div class="flex items-start gap-4 border-b border-muted/10 pb-2">
                        <dt class="w-24 text-muted font-medium">{{ i18n_text(['en' => 'Affiliation', 'uz' => 'Affiliation', 'ja' => '所属']) }}</dt>
                        <dd class="flex-1 text-muted">{{ $application->affiliation ?? i18n_text(['en' => 'Not specified', 'uz' => 'Koʻrsatilmagan', 'ja' => '未指定']) }}</dd>
                    </div>
                    <div class="flex items-start gap-4 border-b border-muted/10 pb-2">
                        <dt class="w-24 text-muted font-medium">{{ i18n_text(['en' => 'Submitted', 'uz' => 'Yuborilgan sana', 'ja' => '提出日']) }}</dt>
                        <dd class="flex-1">{{ $application->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>

                @if ($application->message)
                    <div class="bg-muted/30 rounded-lg p-4 border border-muted/20">
                        <h3 class="text-sm font-semibold mb-2">{{ i18n_text(['en' => 'Message', 'uz' => 'Xabar', 'ja' => 'メッセージ']) }}</h3>
                        <p class="text-sm text-muted whitespace-pre-wrap">{{ $application->message }}</p>
                    </div>
                @endif
            </div>

            <!-- Status action buttons -->
            <div class="academic-card p-6">
                <h3 class="text-sm font-semibold mb-4">{{ i18n_text(['en' => 'Update Status', 'uz' => 'Holatni yangilash', 'ja' => 'ステータスを更新']) }}</h3>
                <div class="space-y-3">
                    <form action="{{ route('admin.join.update', $application->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-green-50 text-green-700 border border-green-200 rounded-lg hover:bg-green-100 transition-colors text-sm font-medium">
                            <span>✅</span> {{ i18n_text(ui('admin.actions.approve')) }}
                        </button>
                    </form>
                    <form action="{{ route('admin.join.update', $application->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                            <span>❌</span> {{ i18n_text(ui('admin.actions.reject')) }}
                        </button>
                    </form>
                    @if ($application->status !== 'pending')
                        <form action="{{ route('admin.join.update', $application->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="pending">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition-colors text-sm font-medium">
                                <span>⏳</span> {{ i18n_text(ui('admin.status.pending')) }}
                            </button>
                        </form>
                    @endif
                </div>

                <a href="{{ route('admin.join.index') }}" class="mt-4 block text-center text-sm font-medium text-secondary hover:text-primary">
                    ← {{ i18n_text(['en' => 'Back to applications list', 'uz' => 'Arizalar roʻyxatiga qaytish', 'ja' => '申請一覧に戻る']) }}
                </a>
            </div>
        </div>

        <!-- Quick actions sidebar -->
        <div class="lg:w-2/5 space-y-6">
            <div class="academic-card p-6">
                <h3 class="text-sm font-semibold mb-4">{{ i18n_text(['en' => 'Quick Stats', 'uz' => 'Teztarmo statistika', 'ja' => 'クイック統計']) }}</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b border-muted/10 pb-2">
                        <span class="text-muted">{{ i18n_text(['en' => 'Application ID', 'uz' => 'Ariza ID', 'ja' => '申請ID']) }}</span>
                        <span class="font-medium text-primary">#{{ $application->id }}</span>
                    </div>
                    <div class="flex justify-between border-b border-muted/10 pb-2">
                        <span class="text-muted">{{ i18n_text(['en' => 'Current status', 'uz' => 'Joriy holat', 'ja' => '現在のステータス']) }}</span>
                        <span class="font-medium">{{ i18n_text(ui('admin.status.' . $application->status)) }}</span>
                    </div>
                    <div class="flex justify-between pb-2">
                        <span class="text-muted">{{ i18n_text(['en' => 'Submitted at', 'uz' => 'Yuborilgan vaqt', 'ja' => '提出時刻']) }}</span>
                        <span class="font-medium">{{ $application->created_at->format('Y-m-d H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
