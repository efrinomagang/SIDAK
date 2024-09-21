@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Manage Mahasiswa</h1>

    <div class="flex justify-between items-center mb-4">
        <!-- Form Pencarian -->
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="flex">
            <input
                type="text"
                name="search"
                class="border border-gray-300 px-4 py-2 rounded-l"
                placeholder="Cari Mahasiswa..."
                value="{{ request('search') }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">
                Search
            </button>
        </form>

        <!-- Tombol Add New Mahasiswa -->
        <a href="{{ route('mahasiswa.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Mahasiswa</a>
    </div>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-center">No</th>
                <th class="py-2 px-4 border-b text-center">NIM</th>
                <th class="py-2 px-4 border-b text-center">Nama</th>
                <th class="py-2 px-4 border-b text-center">Tempat Lahir</th>
                <th class="py-2 px-4 border-b text-center">Tanggal Lahir</th>
                <th class="py-2 px-4 border-b text-center">Kelas</th>
                <th class="py-2 px-4 border-b text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $index => $mahasiswa)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->nim }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->name }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->tempat_lahir }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->tanggal_lahir }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $mahasiswa->kelas ? $mahasiswa->kelas->name : 'N/A' }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="inline-block text-blue-500">
                        <img width="30" height="30" src="https://img.icons8.com/arcade/64/edit-file.png" alt="edit"/>
                    </a>
                    <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">
                            <img width="30" height="30" src="https://img.icons8.com/arcade/64/waste.png" alt="waste"/>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
