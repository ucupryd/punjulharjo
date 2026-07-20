@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        <div>
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                <i class="fa-solid fa-tree"></i>
            </div>
            <h2 class="text-center text-3xl font-heading text-slate-800 font-bold">
                Daftar Akun Member
            </h2>
            <p class="mt-2 text-center text-sm text-slate-500 font-sans">
                Bergabunglah dalam gerakan pemeliharaan pesisir <span class="font-semibold text-emerald-600">My Cemara</span> Desa Punjulharjo.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded text-sm text-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ url('/daftar') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="Contoh: Budi Santoso">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Alamat Email</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="budi@example.com">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="Ulangi password">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full py-3.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-lg shadow-emerald-600/30 transition duration-200">
                    <i class="fa-solid fa-user-plus mr-2"></i> Daftar & Mulai Adopsi
                </button>
            </div>

            <div class="text-center text-sm text-slate-500 pt-2">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:underline">Login di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection
