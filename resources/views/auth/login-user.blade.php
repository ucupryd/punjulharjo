@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
        <div class="text-center">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl font-bold">
                <i class="fa-solid fa-tree"></i>
            </div>
            <h2 class="text-3xl font-bold font-title text-slate-800">Login User / Member</h2>
            <p class="mt-2 text-sm text-slate-500 font-sans">
                Masuk ke akun member Anda untuk memantau adopsi pohon cemara di Pantai Karangjahe.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl text-sm text-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('login.user.submit') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Email Member</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="budi@example.com">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                           placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit"
                        class="w-full py-3.5 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-lg shadow-emerald-600/30 transition duration-200">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk Sebagai Member
                </button>
            </div>

            <div class="flex justify-between items-center text-sm pt-2 border-t border-slate-100">
                <span class="text-slate-500">Belum punya akun?</span>
                <a href="{{ route('member.register') }}" class="font-semibold text-emerald-600 hover:underline">Daftar Member Baru</a>
            </div>
        </form>
    </div>
</div>
@endsection
