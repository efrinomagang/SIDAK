@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Mahasiswa</h1>
    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Edit Mahasiswa in Users Table -->
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username</label>
            <input type="text" name="username" id="username" value="{{ $mahasiswa->user->username }}" class="form-input mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ $mahasiswa->user->email }}" class="form-input mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" class="form-input mt-1 block w-full">
            <p class="text-sm text-gray-500 mt-1">Leave blank if you do not want to change the password.</p>
        </div>

        <!-- Edit Mahasiswa Specific Fields -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Mahasiswa</label>
            <input type="text" name="name" id="name" value="{{ $mahasiswa->name }}" class="form-input mt-1 block w-full">
        </div>

        <!-- Mahasiswa specific fields can be managed separately -->
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
