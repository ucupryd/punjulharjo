@extends('layouts.app')

@section('content')
<section class="relative flex items-center justify-center bg-slate-900 py-24 px-6 md:px-12 overflow-hidden">
    <!-- Scenic Background Overlay -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30 z-0 select-none pointer-events-none" 
         style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-tr from-sky-950 via-slate-950/80 to-indigo-950 z-10 select-none pointer-events-none"></div>

    <!-- Auth Card -->
    <div class="relative z-20 bg-white shadow p-8 md:p-10 max-w-md w-full border border-gray-200 rounded-none transition-all duration-300">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-none bg-sky-50 text-sky-600 mb-4 border border-sky-100 shadow-inner">
                <i class="fa-solid fa-user-plus text-2xl"></i>
            </div>
            <h1 class="text-3xl font-heading text-slate-800 tracking-wide">Daftar Admin</h1>
            <p class="text-slate-500 font-sans text-sm mt-2">Buat akun untuk mengelola konten website Desa Wisata Punjulharjo.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-none mb-6 text-sm font-sans flex items-start gap-2 animate-pulse">
                <i class="fa-solid fa-triangle-exclamation mt-0.5"></i>
                <div class="flex-1">
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" id="name" name="name"
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 outline-none transition"
                           placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                </div>
            </div>

            <div>
                <label for="email" class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" id="email" name="email"
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 outline-none transition"
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
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 outline-none transition"
                           placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-slate-700 font-sans text-sm font-medium mb-1.5">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full bg-white border border-slate-300 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 outline-none transition"
                           placeholder="Ketik ulang password" required>
                </div>
            </div>

            <div class="pt-2 border-t border-slate-100">
                <label for="kode_keamanan" class="block text-slate-800 font-sans text-sm font-semibold mb-1.5">
                    Kode Keamanan Pendaftaran
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-sky-600">
                        <i class="fa-solid fa-key"></i>
                    </span>
                    <input type="password" id="kode_keamanan" name="kode_keamanan"
                           class="w-full bg-sky-50/50 border border-sky-200 rounded-none pl-10 pr-4 py-2.5 font-sans text-sm text-slate-800 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 outline-none transition"
                           placeholder="Masukkan kode rahasia staf" required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-sans font-medium py-3 rounded-none shadow hover:shadow-sm transition-all duration-300 flex items-center justify-center gap-2 mt-4">
                Daftar Akun <i class="fa-solid fa-user-plus text-xs"></i>
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-200 text-center text-xs font-sans text-slate-500">
            Sudah memiliki akun admin? <a href="{{ route('login') }}" class="text-sky-600 hover:text-sky-800 font-semibold transition">Login di sini</a>
        </div>
    </div>
</section>
@endsection
