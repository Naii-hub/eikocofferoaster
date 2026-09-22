@extends('layouts.auth-split')

@section('title', 'Login Admin - EIKO Coffee Roaster')

@section('form')
    <div class="text-center lg:text-left mb-8">
        <h2 class="font-display text-2xl lg:text-3xl font-bold text-slate-900 uppercase tracking-wide">Login</h2>
        <p class="text-sm text-slate-500 mt-2">Silakan masuk untuk mengelola dashboard EIKO.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 flex items-center gap-3 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg text-sm">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <div>
            <label class="block text-slate-700 text-sm font-semibold mb-1.5">Email Address</label>
            <div class="relative">
                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                    placeholder="example@eiko.coffee"
                    class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent transition-all text-slate-900 placeholder:text-slate-400" />
            </div>
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-slate-700 text-sm font-semibold mb-1.5">Password</label>
            <div class="relative">
                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="password" name="password" required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-brand-red focus:border-transparent transition-all text-slate-900 placeholder:text-slate-400" />
            </div>
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer select-none">
                <input type="checkbox" name="remember"
                    class="rounded border-slate-300 text-brand-red focus:ring-brand-red focus:ring-offset-0" />
                Ingat saya
            </label>
        </div>

        <button type="submit"
            class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-3.5 rounded-xl hover:shadow-lg hover:from-red-700 hover:to-red-800 transition-all transform hover:-translate-y-0.5">
            Masuk ke Dashboard
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-brand-red hover:text-coffee-700 hover:underline">Daftar sekarang</a>
    </p>
@endsection