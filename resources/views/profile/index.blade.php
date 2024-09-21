@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Profile Mahasiswa</h1>

    @if(session('error'))
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 mb-4">
        <h2 class="text-xl font-semibold mb-2">Informasi Mahasiswa</h2>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Nama:</strong>
            <p class="text-gray-700">{{ $mahasiswa->name }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">NIM:</strong>
            <p class="text-gray-700">{{ $mahasiswa->nim }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Tempat Lahir:</strong>
            <p class="text-gray-700">{{ $mahasiswa->tempat_lahir }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Tanggal Lahir:</strong>
            <p class="text-gray-700">{{ $mahasiswa->tanggal_lahir }}</p>
        </div>

        <div class="mb-4">
            <strong class="block text-sm font-medium">Kelas:</strong>
            <p class="text-gray-700">{{ $mahasiswa->kelas->name ?? 'Tidak Ada Kelas' }}</p>
        </div>
    </div>

    <!-- Edit Profile Button -->
    <div x-data="{ canEdit: {{ $mahasiswa->edit }} }" class="flex items-center">
        <template x-if="canEdit === 0">
            <button class="bg-gray-500 text-white px-4 py-2 rounded flex items-center cursor-not-allowed opacity-50">
                <img width="28" src="https://img.icons8.com/arcade/64/lock.png" alt="lock"/>
                Edit Profile Locked
            </button>
        </template>

        <template x-if="canEdit === 1">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center animate-pulse">
                <img width="28" src="https://img.icons8.com/arcade/64/key.png" alt="key"/>
                Edit Profile
            </a>
        </template>
    </div>
</div>
@endsection
