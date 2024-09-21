{{-- views/dashboard/mahasiswa.blade.php --}}
@extends('layouts.app')

@section('content')
<!-- Welcome Message Only -->
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Selamat Datang, {{ $firstName }}</h1>
</div>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Mahasiswa</h1>

    <div class="bg-white shadow rounded-lg p-6 mb-4">
        <h2 class="text-xl font-semibold mb-2">Informasi Dasar</h2>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Nama:</strong>
            <p class="text-gray-700">{{ $mahasiswa->name }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Kelas:</strong>
            <p class="text-gray-700">{{ $mahasiswa->kelas->name ?? 'Tidak Ada Kelas' }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Wali Dosen:</strong>
            <p class="text-gray-700">{{ $dosen->name ?? 'Tidak ada wali dosen' }}</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-2">Permintaan Edit Data</h2>
        <p class="mb-4">Anda dapat mengajukan permintaan untuk mengedit data Anda sendiri di sini.</p>
        @if($PendingRequestsCount > 0)
            <div class="relative">
                <a href="#" class="bg-gray-200 text-gray-600 px-4 py-2 rounded inline-flex items-center space-x-2 cursor-not-allowed">
                    <span>Permintaan Aktif</span>
                    <img width="20" height="20" src="https://img.icons8.com/arcade/64/hourglass-sand-bottom.png" alt="hourglass-sand-bottom"/>
                </a>
                <div x-data="{ showAlert: false }" x-init="setTimeout(() => showAlert = true, 1)" x-show="showAlert" class="absolute right-0 top-0 mt-2 w-72 bg-blue-500 text-white text-sm rounded-lg shadow-lg p-2">
                    <p class="font-semibold">Anda memiliki permintaan aktif!</p>
                    <p>Silahkan hubungi wali dosen Anda.</p>
                </div>
            </div>
        @else
            <a href="{{ route('profile.request-edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajukan Permintaan Edit</a>
        @endif

        <div class="mt-4">
            <h3 class="text-lg font-semibold">Statistik Permintaan:</h3>
            <ul>
                <li class="border-b py-2">
                    Jumlah Permintaan Disetujui: {{ $DisetujuiCount }}
                </li>
                <li class="border-b py-2">
                    Jumlah Permintaan Ditolak: {{ $DitolakCount }}
                </li>
                <li class="border-b py-2">
                    Jumlah Permintaan Pending: {{ $PendingCount }}
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
