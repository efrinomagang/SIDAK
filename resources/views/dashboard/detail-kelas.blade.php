{{-- dashboard.detail-kelas --}}
@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Detail Kelas</h1>
<!-- Search and Back Button -->
<div class="mb-4 flex items-center space-x-4">
    <!-- Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white py-2 px-4 border-b text-center rounded">
        Dashboard
    </a>
    <!-- Search Field -->
    <form method="GET" action="{{ route('dashboard.detail-kelas') }}" class="flex-grow">
        <div class="flex">
            <input
                type="text"
                name="search"
                class="border border-gray-300 py-2 px-4 border-b  rounded-l w-full"
                placeholder="Cari Kelas ..."
                value="{{ request('search') }}">
            <button type="submit" class="bg-green-500 text-white py-2 px-4 border-b text-center rounded-r">
                Search
            </button>
        </div>
    </form>
</div>
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-center">Nama Kelas</th>
            <th class="py-2 px-4 border-b text-center">Wali Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kelas as $kls)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $kls->name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $kls->dosen->name ?? 'Belum ditunjuk' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
