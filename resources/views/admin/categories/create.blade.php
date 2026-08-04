@extends('layouts.app')

@section('content')
<div class="py-10 bg-slate-50 min-h-[85vh]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

        <div class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kategori Baru</span>
                <h1 class="text-2xl font-bold text-slate-800 font-title mt-0.5">Tambah Kategori</h1>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl">
                &larr; Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl text-sm text-rose-700">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('admin.categories._form', [
            'action' => route('admin.categories.store'),
            'method' => 'POST',
            'category' => null,
            'submitLabel' => 'Simpan Kategori',
        ])
    </div>
</div>
@endsection
