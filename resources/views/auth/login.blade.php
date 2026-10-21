@extends('layouts.app')

@section('content')
    @php
        $pageTitle = ['en' => 'Admin Login', 'uz' => 'Admin kirish', 'ja' => '管理者ログイン'];
    @endphp

    <section class="section-shell pt-20">
        <div class="container-shell max-w-md mx-auto">
            <div class="academic-card p-8">
                <x-i18n :text="ui('admin.join.title')" tag="h2" class="text-2xl font-bold mb-2" />
                <p class="text-muted mb-6">{{ i18n_text(ui('admin.join.subtitle')) }}</p>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-600 p-4 text-red-800 rounded mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.login.authenticate') }}" method="post" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-primary mb-1">Email</label>
                        <input name="email" type="email" required class="form-input w-full" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-primary mb-1">Password</label>
                        <input name="password" type="password" required class="form-input w-full">
                    </div>
                    <button type="submit" class="btn-primary w-full">
                        {{ i18n_text(['en' => 'Sign in', 'uz' => 'Kirish', 'ja' => 'サインイン']) }}
                    </button>
                </form>

                @if (session('success'))
                    <div class="mt-6 bg-green-50 border-l-4 border-green-600 p-4 text-green-800 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
