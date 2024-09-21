@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Kelas</h1>
    <a href="{{ route('kelas.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Tambah Kelas</a>

    <div class="bg-white p-6 rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left py-2">No</th>
                    <th class="text-left py-2">Kelas</th>
                    <th class="text-left py-2">Jumlah</th>
                    <th class="text-left py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelases as $kelas)
                <tr>
                    <td class="py-2">{{ $loop->iteration }}</td>
                    <td class="py-2">{{ $kelas->name }}</td>
                    <td class="py-2">{{ $kelas->jumlah }}</td>
                    <td class="py-2">
                        <a href="{{ route('kelas.edit', $kelas->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</a>
                        <form id="delete-form-{{ $kelas->id }}" action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $kelas->id }})" class="bg-red-500 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
