{{-- views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

    <form action="{{ route('profile.update', $mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username', $mahasiswa->user->username) }}" class="form-input mt-1 block w-full" />
            @error('username')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $mahasiswa->user->email) }}" class="form-input mt-1 block w-full" />
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password:</label>
            <input type="password" id="password" name="password" class="form-input mt-1 block w-full" />
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $mahasiswa->name) }}" class="form-input mt-1 block w-full" />
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- NIM -->
        <div class="mb-4">
            <label for="nim" class="block text-sm font-medium">NIM:</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="form-input mt-1 block w-full" />
            @error('nim')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tempat Lahir -->
        <div class="mb-4">
            <label for="tempat_lahir" class="block text-sm font-medium">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir) }}" class="form-input mt-1 block w-full" />
            @error('tempat_lahir')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div class="mb-4">
            <label for="tanggal_lahir" class="block text-sm font-medium">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}" class="form-input mt-1 block w-full" />
            @error('tanggal_lahir')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center animate-pulse"><img width="28" src="https://img.icons8.com/arcade/64/landlord.png" alt="landlord"/>Update Profile</button>
    </form>
</div>
@endsection
