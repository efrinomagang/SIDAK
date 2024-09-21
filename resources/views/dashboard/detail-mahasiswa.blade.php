@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Detail Mahasiswa</h1>

<!-- Search and Back Button -->
<div class="mb-4 flex items-center space-x-4">
    <!-- Dashboard Button -->
    <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
        Dashboard
    </a>
    <!-- Search Field -->
    <form method="GET" action="{{ route('dashboard.detail-mahasiswa') }}" class="flex-grow">
        <div class="flex">
            <input
                type="text"
                name="search"
                class="border border-gray-300 px-4 py-2 rounded-l w-full"
                placeholder="Cari Mahasiswa..."
                value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">
                Search
            </button>
        </div>
    </form>
</div>

<!-- Table -->
<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4 border-b text-center">No.</th>
            <th class="py-2 px-4 border-b text-center">NIM</th>
            <th class="py-2 px-4 border-b text-center">Nama</th>
            <th class="py-2 px-4 border-b text-center">Kelas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswas as $index => $mahasiswa)
            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->nim }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->kelas->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
