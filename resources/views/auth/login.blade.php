@extends('layouts.app')

@section('content')
<section class="relative flex items-center justify-center bg-slate-900 py-24 px-6 md:px-12 overflow-hidden">
    <!-- Scenic Background Overlay -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30 z-0 select-none pointer-events-none" 
         style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-tr from-brand-dark/90 via-slate-950/80 to-brand-light/95 z-10 select-none pointer-events-none"></div>

    <!-- Auth Card -->
    <div class="relative z-20 bg-white shadow p-8 md:p-10 max-w-md w-full border border-gray-200 rounded-none transition-all duration-300">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-none bg-brand-muted/10 text-brand-dark mb-4 border border-brand-muted/20 shadow-inner">
                <i class="fa-solid fa-user-shield text-2xl"></i>
            </div>
            <h1 class="text-3xl font-heading text-brand-dark tracking-wide">Login Admin</h1>
            <p class="text-slate-500 font-sans text-sm mt-2">Masukkan email dan password untuk mengakses dashboard admin.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-none mb-6 text-sm font-sans flex items-start gap-2 animate-pulse">
                <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>
                <div>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="email" name="email"
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-brand-light/20 focus:border-brand-light outline-none transition"
                           placeholder="admin@punjulharjo.desa.id" value="{{ old('email') }}" required>
                </div>
            </div>

            <div>
                <label for="password" class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" id="password" name="password"
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-brand-light/20 focus:border-brand-light outline-none transition"
                           placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-brand-dark text-white hover:bg-brand-accent hover:text-brand-dark transition-colors font-sans font-semibold py-3 rounded-none shadow hover:shadow-sm flex items-center justify-center gap-2">
                Masuk <i class="fa-solid fa-arrow-right text-xs"></i>
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-200 text-center text-xs font-sans text-slate-500">
            Belum memiliki akun admin? <a href="{{ route('register') }}" class="text-brand-dark hover:text-brand-light font-semibold transition">Daftar di sini</a>
        </div>
    </div>
</section>
@endsection
