{{-- resources/views/dashboard/detail-dosen.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Detail Dosen</h1>
    <div class="mb-4 flex items-center space-x-4">
        <!-- Dashboard Button -->
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white py-2 px-4 border-b text-center rounded">
            Dashboard
        </a>
        <!-- Search Field -->
        <form method="GET" action="{{ route('dashboard.detail-dosen') }}" class="flex-grow">
            <div class="flex">
                <input
                    type="text"
                    name="search"
                    class="border border-gray-300 py-2 px-4 border-b  rounded-l w-full"
                    placeholder="Cari Dosen ..."
                    value="{{ request('search') }}">
                <button type="submit" class="bg-green-500 text-white py-2 px-4 border-b text-center rounded-r">
                    Search
                </button>
            </div>
        </form>
    </div>


    <div class="bg-white p-6 rounded-lg shadow-md">
        @if($dosens->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($dosens as $dosen)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dosen->nip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dosen->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dosen->user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($dosen->kelas)
                                    {{ $dosen->kelas->name }}
                                @else
                                    Tidak Ditugaskan
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-700">No dosen data available.</p>
        @endif
    </div>
</div>
@endsection
