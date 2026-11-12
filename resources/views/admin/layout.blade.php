<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · {{ config('uac.site.short_name', 'UAC Japan') }} Admin</title>
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    @php
        $nav = [
            ['route' => 'admin.dashboard', 'match' => 'admin.dashboard', 'icon' => '📊', 'label' => ['en' => 'Dashboard', 'uz' => 'Boşqaruv paneli', 'ja' => 'ダッシュボード']],
            ['route' => 'admin.join.index', 'match' => 'admin.join.*', 'icon' => '📋', 'label' => ['en' => 'Applications', 'uz' => 'Arizalar', 'ja' => '申請']],
            ['route' => 'admin.regions.index', 'match' => 'admin.regions.*', 'icon' => '🗾', 'label' => ['en' => 'Regions', 'uz' => 'Regionlar', 'ja' => '地域']],
            ['route' => 'admin.members.index', 'match' => 'admin.members.*', 'icon' => '👥', 'label' => ['en' => 'Members', 'uz' => 'Aʼzolar', 'ja' => 'メンバー']],
            ['route' => 'admin.events.index', 'match' => 'admin.events.*', 'icon' => '📅', 'label' => ['en' => 'Events', 'uz' => 'Tadbirlar', 'ja' => 'イベント']],
            ['route' => 'admin.news.index', 'match' => 'admin.news.*', 'icon' => '📰', 'label' => ['en' => 'News', 'uz' => 'Yangiliklar', 'ja' => 'ニュース']],
            ['route' => 'admin.settings.edit', 'match' => 'admin.settings.*', 'icon' => '⚙️', 'label' => ['en' => 'Settings', 'uz' => 'Sozlamalar', 'ja' => '設定']],
        ];
    @endphp

    <div id="admin-overlay" class="admin-overlay" data-admin-toggle></div>

    <aside id="admin-sidebar" class="admin-sidebar" aria-label="Admin navigation">
        <div class="flex items-center gap-3 border-b border-line px-5 py-4">
            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary font-bold text-white">U</div>
            <div>
                <p class="font-display text-lg leading-tight text-primary">{{ config('uac.site.short_name', 'UAC Japan') }}</p>
                <p class="text-xs text-muted">{{ i18n_text(['en' => 'Admin Panel', 'uz' => 'Admin panel', 'ja' => '管理パネル']) }}</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto p-3">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}" class="admin-nav-link {{ request()->routeIs($item['match']) ? 'is-active' : '' }}">
                    <span aria-hidden="true">{{ $item['icon'] }}</span> {{ i18n_text($item['label']) }}
                </a>
            @endforeach
        </nav>

        <div class="space-y-2 border-t border-line p-3">
            <a href="{{ route('home') }}" target="_blank" class="admin-nav-link">
                <span aria-hidden="true">🌐</span> {{ i18n_text(['en' => 'View site', 'uz' => 'Saytni köriş', 'ja' => 'サイトを表示']) }}
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-nav-link w-full text-red-600 hover:bg-red-50 hover:text-red-700">
                    <span aria-hidden="true">🚪</span> {{ i18n_text(ui('admin.actions.logout')) }}
                </button>
            </form>
        </div>
    </aside>

    <div class="admin-main md:pl-64">
        <header class="sticky top-0 z-30 flex items-center justify-between gap-4 border-b border-line bg-white/85 px-4 py-3 backdrop-blur md:px-8">
            <button type="button" class="rounded-lg p-2 text-xl text-primary md:hidden" data-admin-toggle aria-controls="admin-sidebar" aria-label="Toggle navigation">☰</button>
            <p class="hidden text-sm font-semibold text-primary md:block">@yield('title', 'Admin')</p>
            <div class="flex items-center gap-3">
                <span class="hidden text-sm text-muted sm:block">{{ session('admin_email') }}</span>
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">
                    {{ strtoupper(substr(session('admin_email', 'A'), 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="space-y-6 p-4 md:p-8">
            @if (session('success'))
                <div class="rounded-xl border-l-4 border-green-600 bg-green-50 p-4 text-sm text-green-800" role="status">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="rounded-xl border-l-4 border-red-600 bg-red-50 p-4 text-sm text-red-800" role="alert">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-xl border-l-4 border-red-600 bg-red-50 p-4 text-sm text-red-800" role="alert">
                    <p class="font-semibold">{{ i18n_text(['en' => 'Please fix the following:', 'uz' => 'Quyidagilarni tuzating:', 'ja' => '以下を修正してください：']) }}</p>
                    <ul class="mt-2 list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        document.querySelectorAll('[data-admin-toggle]').forEach((el) => el.addEventListener('click', () => {
            document.getElementById('admin-sidebar').classList.toggle('is-open');
            document.getElementById('admin-overlay').classList.toggle('is-open');
        }));
        document.querySelectorAll('form[data-confirm]').forEach((form) => form.addEventListener('submit', (e) => {
            if (! confirm(form.dataset.confirm)) e.preventDefault();
        }));
        document.querySelectorAll('[data-translate]').forEach((button) => button.addEventListener('click', async () => {
            const group = button.closest('[data-locale-input]');
            const status = group.querySelector('[data-translate-status]');
            const fields = Object.fromEntries([...group.querySelectorAll('[data-locale]')].map((el) => [el.dataset.locale, el]));
            const say = (text, isError = false) => {
                status.textContent = text;
                status.classList.toggle('hidden', ! text);
                status.classList.toggle('text-red-600', isError);
            };

            const source = button.dataset.source;
            const targets = button.dataset.targets.split(',');
            const text = fields[source].value.trim();
            const to = targets.filter((locale) => ! fields[locale].value.trim());
            const names = (locales) => locales.map((l) => l.toUpperCase()).join(', ');
            if (! text) return say('Write the ' + source.toUpperCase() + ' text first.', true);

            button.disabled = true;
            say('Translating…');
            try {
                const response = await fetch(@json(route('admin.translate')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({ text, to }),
                });
                const data = await response.json().catch(() => ({}));
                if (! response.ok) throw new Error(data.message || 'Translation failed.');
                if (! data.translations) throw new Error('Your session may have expired. Reload the page and log in again.');

                // The source field is always rewritten in the new alphabet; a
                // target field only when it was empty (to already filters those).
                const updated = Object.entries(data.translations)
                    .filter(([locale, value]) => value !== undefined && value !== null && fields[locale] && (locale === source || to.includes(locale)))
                    .map(([locale, value]) => { fields[locale].value = value; return locale; });

                say(updated.length ? 'Updated ' + names(updated) + '. Review before saving.' : names(targets) + ' are already filled. Clear one to translate it again.');
            } catch (error) {
                say(error.message, true);
            } finally {
                button.disabled = false;
            }
        }));
    </script>
    @stack('scripts')
</body>
</html>
