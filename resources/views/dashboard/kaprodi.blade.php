{{-- dashboard.kaprodi --}}
@extends('layouts.app')
@section('content')

<!-- Welcome Message & Profile Icon -->
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">
        Selamat Datang, {{ $firstName }}
    </h1>
    <div>
        <!-- Avatar as a link to profile page -->
        <a href="{{ route('dashboard.detail-profile') }}">
            <img class="h-10 w-10 rounded-full" src="https://img.icons8.com/arcade/64/administrator-male.png" alt="administrator"/>
        </a>
    </div>
</div>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Kaprodi</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Clickable Card for Total Mahasiswa -->
        <a href="{{ route('dashboard.detail-mahasiswa') }}" class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors">
            <h2 class="text-xl font-semibold mb-2">Jumlah Mahasiswa</h2>
            <p class="text-2xl font-bold">{{ $totalMahasiswa }}</p>
        </a>

        <!-- Clickable Card for Total Dosen -->
        <a href="{{ route('dashboard.detail-dosen') }}" class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors">
            <h2 class="text-xl font-semibold mb-2">Jumlah Dosen</h2>
            <p class="text-2xl font-bold">{{ $totalDosen }}</p>
        </a>

        <!-- Clickable Card for Total Kelas -->
        <a href="{{ route('dashboard.detail-kelas') }}" class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors">
            <h2 class="text-xl font-semibold mb-2">Jumlah Kelas</h2>
            <p class="text-2xl font-bold">{{ $totalKelas }}</p>
        </a>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Manage Dosen</h2>
            <p class="mb-4">Lihat, tambahkan, dan kelola dosen di sini.</p>
            <a href="{{ route('dosen.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Kelola Dosen
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Manage Kelas</h2>
            <p class="mb-4">Lihat, tambahkan, dan kelola kelas di sini.</p>
            <a href="{{ route('kelas.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">
                Kelola Kelas
            </a>
        </div>
    </div>
</div>
@endsection
