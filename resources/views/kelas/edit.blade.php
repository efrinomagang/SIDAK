@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kelas</h1>
    <form action="{{ route('kelas.update', $kelas) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Kelas</label>
            <input type="text" name="name" id="name" value="{{ old('name', $kelas->name) }}" class="form-input mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium">Jumlah Mahasiswa</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $kelas->jumlah) }}" class="form-input mt-1 block w-full">
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
