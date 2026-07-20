@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-900">
    <div class="max-w-md w-full space-y-8 bg-slate-800 p-8 rounded-2xl shadow-2xl border border-slate-700 text-white">
        <div class="text-center">
            <div class="w-16 h-16 bg-sky-500/20 text-sky-400 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold border border-sky-500/30">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h2 class="text-3xl font-bold font-title text-white">Login Admin Panel</h2>
            <p class="mt-2 text-sm text-slate-400 font-sans">
                Akses khusus pengelola & administrator Desa Wisata Punjulharjo.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-500/10 border-l-4 border-rose-500 p-4 rounded-xl text-sm text-rose-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login.admin.submit') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Email Administrator</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition"
                           placeholder="admin@punjulharjo.desa.id">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Password Admin</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 bg-slate-900 border border-slate-700 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition"
                           placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full py-3.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-sky-600 hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 shadow-lg shadow-sky-600/30 transition duration-200">
                    <i class="fa-solid fa-lock mr-2"></i> Masuk Admin Panel
                </button>
            </div>

            <div class="text-center text-xs text-slate-500 pt-2 border-t border-slate-700/50">
                Pendaftaran admin memerlukan kode keamanan. <a href="{{ route('register') }}" class="text-sky-400 hover:underline">Register Admin</a>
            </div>
        </form>
    </div>
</div>
@endsection
