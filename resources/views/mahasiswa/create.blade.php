@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Add Mahasiswa</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">Error:</strong>
            <ul class="list-disc pl-5 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username</label>
            <input type="text" name="username" id="username" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium">NIM</label>
            <input type="text" name="nim" id="nim" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Mahasiswa</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="tempat_lahir" class="block text-sm font-medium">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="tanggal_lahir" class="block text-sm font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="kelas_id" class="block text-sm font-medium">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-select mt-1 block w-full">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add</button>
    </form>
</div>
@endsection
