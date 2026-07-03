@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-100 to-white px-6">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-sky-600 mb-6">Login Admin</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                       placeholder="Masukkan email admin" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit"
                    class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 rounded-lg transition">
                Masuk
            </button>
        </form>
    </div>
</section>
@endsection
