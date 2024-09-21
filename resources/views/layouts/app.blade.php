{{-- layouts.app --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Mahasiswa</title>{{-- Logo for title --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="flex bg-gray-100 min-h-screen" x-data="{ sidebarOpen: false }">
<!-- Sidebar -->
<div :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed top-0 left-0 h-full bg-gray-800 text-white transition-all duration-300 z-30 flex flex-col justify-between">
    <div>
        <!-- Logo and Brand -->
        <div class="flex items-center p-4">
            <img class="w-10 h-10" src="https://web.polines.ac.id/wp-content/uploads/2022/01/Logo-Polines-96dpi-200px.png" alt="Logo">
            <span :class="sidebarOpen ? 'ml-4 font-bold' : 'hidden'" class="transition-all duration-300">SIDAK</span>
        </div>

        <!-- Sidebar Menu -->
        <ul class="space-y-4 mt-6">
            <li class="p-4 hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-600' : '' }}">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img width="40" height="40" src="https://img.icons8.com/arcade/64/home-office.png" alt="dashboard"/>
                    <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Dashboard</span>
                </a>
            </li>

            {{-- Separator between role menu and logout --}}
            <div class="border-t border-gray-700"></div>

            @if(Auth::user()->role === 'kaprodi')
                <li class="p-4 hover:bg-gray-700 {{ request()->is('dosen*') ? 'bg-gray-600' : '' }}">
                    <a href="{{ route('dosen.index') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/men-age-group-5.png" alt="manage-dosen"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Manage Dosen</span>
                    </a>
                </li>
                <li class="p-4 hover:bg-gray-700 {{ request()->is('kelas*') ? 'bg-gray-600' : '' }}">
                    <a href="{{ route('kelas.index') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/meeting-room.png" alt="manage-class"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Manage Kelas</span>
                    </a>
                </li>
                @elseif(Auth::user()->role === 'dosen')
                <li class="p-4 {{ request()->is('mahasiswa*') ? 'bg-gray-600' : 'hover:bg-gray-700' }}
                    @if(Auth::user()->dosen->kelas_id === null) pointer-events-none opacity-50 @endif">
                    <a href="{{ route('mahasiswa.index') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/management.png" alt="manage-mahasiswa"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Manage Mahasiswa</span>
                    </a>
                </li>

                <li class="p-4 {{ request()->is('mahasiswa/edit-requests*') ? 'bg-gray-600' : 'hover:bg-gray-700' }}
                    @if(Auth::user()->dosen->kelas_id === null) pointer-events-none opacity-50 @endif">
                    <a href="{{ route('mahasiswa.edit-requests') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/help.png" alt="approve/reject"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Edit Requests</span>
                    </a>
                </li>

            @elseif(Auth::user()->role === 'mahasiswa')
                <li class="p-4 hover:bg-gray-700 {{ request()->is('profile*') ? 'bg-gray-600' : '' }}">
                    <a href="{{ route('profile.index') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/edit-user-male.png" alt="profile"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Profile</span>
                    </a>
                </li>
                <li class="p-4 hover:bg-gray-700 {{ request()->is('profile/request-edit*') ? 'bg-gray-600' : '' }}">
                    <a href="{{ route('profile.request-edit') }}" class="flex items-center">
                        <img width="40" height="40" src="https://img.icons8.com/arcade/64/why-us-male.png" alt="request"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Request Edit</span>
                    </a>
                </li>
            @endif

            {{-- Separator before Logout --}}
            <div class="border-t border-gray-700"></div>

            <li class="p-4 hover:bg-gray-700">
                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Are you sure you want to log out?');">
                    @csrf
                    <button type="submit" class="flex items-center w-full">
                        <img width="40" height="40" src="https://img.icons8.com/fluency/48/shutdown.png" alt="shutdown"/>
                        <span :class="sidebarOpen ? 'ml-4' : 'hidden'" class="transition-all duration-300">Logout</span>
                    </button>
                </form>
            </li>
        </ul>

    </div>

    <!-- Sidebar Toggle Button -->
    <div class="p-4 hover:bg-gray-700 cursor-pointer flex items-center justify-center" @click="sidebarOpen = !sidebarOpen">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <!-- First line (top) -->
            <line :class="sidebarOpen ? 'rotate-45 translate-y-2' : 'translate-y-0'"
                  class="transition-transform origin-center" x1="-6" y1="6" x2="20" y2="6"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

            <!-- Middle line (hidden when sidebar open) -->
            <line :class="sidebarOpen ? 'opacity-0' : 'opacity-100'"
                  class="transition-opacity origin-center" x1="4" y1="12" x2="20" y2="12"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

            <!-- Last line (bottom) -->
            <line :class="sidebarOpen ? '-rotate-45 -translate-y-2' : 'translate-y-0'"
                  class="transition-transform origin-center" x1="-6" y1="18" x2="20" y2="18"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 p-6 transition-all duration-300">
    <!-- Dynamic Content -->
    @yield('content')
</div>

</body>
</html>
