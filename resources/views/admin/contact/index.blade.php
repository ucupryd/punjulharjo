@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-sky-700 mb-6">Pesan yang Masuk</h2>

@if ($messages->count() > 0)
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full">
            <thead class="bg-sky-100 text-sky-700">
                <tr>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Pesan</th>
                    <th class="py-3 px-4 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                    <tr class="border-b hover:bg-sky-50">
                        <td class="py-3 px-4 font-medium">{{ $msg->name }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $msg->email }}</td>
                        <td class="py-3 px-4 text-gray-700 max-w-sm">
                            {{ Str::limit($msg->message, 80) }}
                        </td>
                        <td class="py-3 px-4 text-gray-500">{{ $msg->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@else
    <p class="text-gray-600">Belum ada pesan yang masuk.</p>
@endif
@endsection
