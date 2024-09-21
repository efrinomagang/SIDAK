@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-4 flex items-center space-x-4">
        <!-- Dashboard Button -->
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
            Dashboard
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-4 text-center sm:text-left">Profile Details</h1>

    <!-- Avatar Section -->
    <div class="flex justify-center mb-6">
        <img src="https://scholar.googleusercontent.com/citations?view_op=view_photo&user=m3KxLFYAAAAJ&citpid=1" alt="Avatar" class="w-24 h-24 rounded-full border border-gray-300">
    </div>

    <!-- Display Profile Details -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-full max-w-lg mx-auto">
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Edit Profile Button -->
        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full sm:w-auto" id="editProfileBtn">Edit Profile</button>
    </div>

    <!-- Modal for Editing Profile -->
    <div id="editProfileModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 sm:mx-0">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

            <!-- Profile Edit Form -->
            <form action="{{ route('dashboard.update-profile', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-bold mb-2">Username:</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Change -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">New Password (Leave blank to keep current):</label>
                    <input type="password" id="password" name="password" class="border border-gray-300 rounded-lg p-2 w-full">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="border border-gray-300 rounded-lg p-2 w-full">
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg w-full sm:w-auto">Update Profile</button>
            </form>

            <!-- Close Button -->
            <button class="mt-4 text-red-500 w-full sm:w-auto" id="closeModalBtn">Cancel</button>
        </div>
    </div>
</div>

<!-- Success/Failure Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg text-center mx-4 sm:mx-0">
        <p id="statusMessage" class="text-lg font-bold mb-4"></p>
        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg w-full sm:w-auto" id="closeStatusModalBtn">Close</button>
    </div>
</div>

<!-- Script to Toggle Modals and Timer for Success/Failure -->
<script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('editProfileModal').classList.remove('hidden');
        document.getElementById('editProfileModal').classList.add('flex');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('editProfileModal').classList.add('hidden');
        document.getElementById('editProfileModal').classList.remove('flex');
    });

    document.getElementById('closeStatusModalBtn').addEventListener('click', function() {
        document.getElementById('statusModal').classList.add('hidden');
        document.getElementById('statusModal').classList.remove('flex');
    });

    // Show status message modal on page load if session success or failure exists
    @if(session('success'))
        document.getElementById('statusMessage').innerText = '{{ session('success') }}';
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');

        setTimeout(function() {
            document.getElementById('statusModal').classList.add('hidden');
            document.getElementById('statusModal').classList.remove('flex');
        }, 3000); // Auto-close after 3 seconds
    @elseif(session('error'))
        document.getElementById('statusMessage').innerText = '{{ session('error') }}';
        document.getElementById('statusModal').classList.remove('hidden');
        document.getElementById('statusModal').classList.add('flex');

        setTimeout(function() {
            document.getElementById('statusModal').classList.add('hidden');
            document.getElementById('statusModal').classList.remove('flex');
        }, 3000); // Auto-close after 3 seconds
    @endif
</script>
@endsection
