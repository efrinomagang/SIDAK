<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pendataan Mahasiswa</title>
    @vite('resources/css/app.css')
    <style>
        /* Add animation styles */
        .fade-in {
            opacity: 0;
            animation: fadeIn ease 2s;
            animation-fill-mode: forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96 fade-in">
        <!-- Avatar -->
        <div class="flex justify-center mb-6">
            <img width="64" height="64" src="https://img.icons8.com/arcade/64/graduation-cap.png" alt="Avatar" class="h-24 w-24 rounded-full">
        </div>

        <h2 class="text-2xl mb-6 text-center">Login</h2>

        <!-- Show error messages if any -->
        @if ($errors->any())
            <div class="mb-4 text-red-500 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="login" class="block mb-2">Email or Username</label>
                <input type="text" name="login" class="w-full px-3 py-2 border rounded" required placeholder="Enter your email or username">
            </div>

            <div class="mb-6">
                <label for="password" class="block mb-2">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded" required placeholder="Enter your password">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded transition transform hover:scale-105">Login</button>
        </form>

        <!-- Back to Welcome Button -->
        <div class="mt-4 text-center">
            <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Back to Welcome</a>
        </div>
    </div>
</body>
</html>
