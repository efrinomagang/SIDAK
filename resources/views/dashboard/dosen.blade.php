{{-- dashboard.dosen --}}
@extends('layouts.app')

@section('content')
<!-- Welcome Message Only -->
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Selamat Datang, {{ $firstName }}</h1>
</div>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Dosen</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        {{-- <h2 class="text-xl font-semibold mb-4">Welcome, {{ auth()->user()->username }}</h2> --}}
        <p class="text-gray-700 mb-4">You are assigned to the following classes:</p>

        @if(auth()->user()->dosen->kelas_id)
            @php
                $kelas = \App\Models\Kelas::with('mahasiswas')->find(auth()->user()->dosen->kelas_id);
            @endphp

            @if($kelas)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Class Information</h3>
                    <p><strong>Class Name:</strong> {{ $kelas->name }}</p>
                    <p><strong>Number of Students:</strong> {{ $kelas->mahasiswas->count() }}</p>
                </div>
            @else
                <p class="text-gray-700 mb-4">Class information is not available.</p>
            @endif
        @else
            <p class="text-gray-700 mb-4">Anda tidak ditunjuk sebagai wali kelas.</p>
        @endif

        @if(auth()->user()->dosen->kelas_id)
            <div class="mt-6">
                <a href="{{ route('mahasiswa.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Manage Students</a>
            </div>
            <div class="mt-6">
                <a href="{{ route('mahasiswa.edit-requests') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">View Edit Requests</a>
            </div>
        @endif
    </div>
    <br>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             <!-- Clickable Card for Total Mahasiswa -->
             <a href="{{ route('dashboard.detail-mahasiswa') }}" class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors">
                <h2 class="text-xl font-semibold mb-2">Jumlah Mahasiswa</h2>
                <p class="text-2xl font-bold">{{ $totalMahasiswa }}</p>
            </a>

         <!-- Clickable Card for Total Kelas -->
         <a href="{{ route('dashboard.detail-kelas') }}" class="bg-white p-6 rounded-lg shadow hover:bg-gray-50 transition-colors">
            <h2 class="text-xl font-semibold mb-2">Jumlah Kelas</h2>
            <p class="text-2xl font-bold">{{ $totalKelas }}</p>
        </a>
    </div>

</div>
@endsection
