{{-- resources/views/dosen/index.blade.php --}}
@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Dosen</h1>
    <a href="{{ route('dosen.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Tambah Dosen</a>

    <div class="bg-white p-6 rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left py-2">No.</th>
                    <th class="text-left py-2">Nama</th>
                    <th class="text-left py-2">NIP</th>
                    <th class="text-left py-2">Kode Dosen</th>
                    <th class="text-left py-2">Kelas</th>
                    <th class="text-left py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosens as $dosen)
                <tr>
                    <td class="py-2">{{ $loop->iteration }}</td>
                    <td class="py-2">{{ $dosen->name }}</td>
                    <td class="py-2">{{ $dosen->nip }}</td>
                    <td class="py-2">{{ $dosen->kode_dosen }}</td>
                    <td class="py-2">{{ $dosen->kelas->name ?? '-' }}</td>
                    <td class="py-2">
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
