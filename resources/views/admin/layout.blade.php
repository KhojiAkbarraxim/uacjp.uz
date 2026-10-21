<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @php
        $locale = app()->getLocale();
        $titleDict = i18n_dict($pageTitle ?? ['en' => 'Admin', 'uz' => 'Admin', 'ja' => '管理']);
    @endphp
    <title data-i18n-en="{{ $titleDict['en'] }}" data-i18n-uz="{{ $titleDict['uz'] }}" data-i18n-ja="{{ $titleDict['ja'] }}">{{ $titleDict[$locale] }}</title>
    <meta name="description" content="{{ i18n_text($metaDescription ?? ['en' => 'UAC Japan Admin Panel', 'uz' => 'UAC Japan admin panel', 'ja' => 'UAC Japan 管理パネル']) }}" />
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Admin sidebar */
        #admin-sidebar {
            @apply fixed inset-y-0 left-0 z-50 w-64 bg-white/95 border-r border-muted/20 transform -translate-x-full transition-transform duration-300;
        }
        #admin-sidebar.open { @apply translate-x-0; }
        #admin-overlay {
            @apply fixed inset-0 z-40 bg-black/50 hidden backdrop-blur-sm transition-opacity duration-300;
        }
        #admin-overlay.open { @apply block opacity-100; }
        #admin-main {
            @apply transition-margin duration-300;
        }
        @media (min-width: 768px) {
            #admin-sidebar { @apply relative translate-x-0 static w-64; }
            #admin-overlay { @apply hidden !important; }
            #admin-main { @apply ml-64; }
        }
        .nav-link { @apply flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors; }
        .nav-link.active { @apply bg-primary/10 text-primary border-r-4 border-primary; }
        .nav-link:hover { @apply bg-muted/50; }
        .table-responsive { @apply overflow-x-auto; }
        @media (max-width: 640px) {
            .stack-table thead { @apply hidden; }
            .stack-table tbody tr { @apply block mb-4 border border-muted/20 rounded-lg overflow-hidden; }
            .stack-table tbody td { @apply block text-right px-4 py-2 border-t border-muted/10; }
            .stack-table tbody td::before { @apply content-['attr(data-label)'] font-semibold text-primary block text-left; }
        }
    </style>
</head>
<body class="min-h-screen bg-muted/50">
    <!-- Mobile overlay -->
    <div id="admin-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar">
        <div class="p-5 border-b border-muted/20 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white font-bold">U</div>
            <span class="font-bold text-lg tracking-tight text-primary">{{ config('app.short_name', 'UAC Japan') }}</span>
        </div>

        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>📊</span> {{ i18n_text(['en' => 'Dashboard', 'uz' => 'Boshqaruv paneli', 'ja' => 'ダッシュボード']) }}
            </a>
            <a href="{{ route('admin.join.index') }}" class="nav-link {{ request()->routeIs('admin.join.*') ? 'active' : '' }}">
                <span>📋</span> {{ i18n_text(['en' => 'Applications', 'uz' => 'Arizalar', 'ja' => '申請']) }}
            </a>
            <a href="#" class="nav-link text-muted/70 hover:bg-muted/50">
                <span>👥</span> {{ i18n_text(['en' => 'Members', 'uz' => 'Aʼzolar', 'ja' => 'メンバー']) }}
            </a>
            <a href="#" class="nav-link text-muted/70 hover:bg-muted/50">
                <span>📅</span> {{ i18n_text(['en' => 'Events', 'uz' => 'Tadbirlar', 'ja' => 'イベント']) }}
            </a>
            <a href="#" class="nav-link text-muted/70 hover:bg-muted/50">
                <span>⚙️</span> {{ i18n_text(['en' => 'Settings', 'uz' => 'Sozlamalar', 'ja' => '設定']) }}
            </a>
        </nav>

        <div class="p-4 border-t border-muted/20 mt-auto">
            <a href="{{ route('admin.logout') }}" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>🚪</span> {{ i18n_text(ui('admin.actions.logout')) }}
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </aside>

    <!-- Main content -->
    <main id="admin-main" class="min-h-screen p-4 md:p-6">
        <!-- Top user bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-2 cursor-pointer" onclick="toggleSidebar()">
                <span class="text-xl">☰</span>
                <span class="hidden md:block font-semibold text-primary text-sm">{{ i18n_text(['en' => 'Admin Panel', 'uz' => 'Admin panel', 'ja' => '管理パネル']) }}</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden md:block text-sm text-muted">{{ session('admin_email', 'admin@uacjp.uz') }}</span>
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
                    {{ strtoupper(substr(session('admin_email', 'a@uacjp.uz'), 0, 1)) }}
                </div>
            </div>
        </div>

        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('admin-overlay');
            const isOpen = sidebar.classList.contains('open');
            if (isOpen) {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            } else {
                sidebar.classList.add('open');
                overlay.classList.add('open');
            }
        }
        // Close sidebar on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                document.getElementById('admin-sidebar').classList.remove('open');
                document.getElementById('admin-overlay').classList.remove('open');
            }
        });
    </script>
</body>
</html>
