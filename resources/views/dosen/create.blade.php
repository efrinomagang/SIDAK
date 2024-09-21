{{-- views/dosen/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Dosen</h1>

    <form action="{{ route('dosen.store') }}" method="POST">
        @csrf

        {{-- Nama Dosen --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Dosen</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
        </div>

        {{-- NIP --}}
        <div class="mb-4">
            <label for="nip" class="block text-sm font-medium">NIP</label>
            <input type="text" name="nip" id="nip" class="form-input mt-1 block w-full" required>
        </div>

        {{-- Kode Dosen --}}
        <div class="mb-4">
            <label for="kode_dosen" class="block text-sm font-medium">Kode Dosen</label>
            <input type="text" name="kode_dosen" id="kode_dosen" class="form-input mt-1 block w-full" required>
        </div>

        {{-- Username --}}
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username</label>
            <input type="text" name="username" id="username" class="form-input mt-1 block w-full" required>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="form-input mt-1 block w-full" required>
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" class="form-input mt-1 block w-full" required>
        </div>

        {{-- Kelas --}}
        <div class="mb-4">
            <label for="kelas_id" class="block text-sm font-medium">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-select mt-1 block w-full">
                <option value="">Pilih Kelas</option>
                @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
