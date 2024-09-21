@extends('layouts.app')

@section('content')
<!-- Modal Konfirmasi Alpine.js -->
<div x-data="{ showModal: false }" x-init="$watch('showModal', value => { if (value) document.getElementById('confirmYes').focus(); })">
    <form id="createKelasForm" action="{{ route('kelas.store') }}" method="POST" @submit.prevent="if (!showModal) { $el.submit(); }">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nama Kelas</label>
            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium">Jumlah Mahasiswa</label>
            <input type="number" name="jumlah" id="jumlah" class="form-input mt-1 block w-full" required
            @change="if ($event.target.value > 0) showModal = true"> <!-- Menampilkan modal ketika jumlah > 0 -->
        </div>

        <!-- Hidden input untuk menyimpan nilai apakah akan membuat mahasiswa otomatis -->
        <input type="hidden" name="auto_create_mahasiswa" id="auto_create_mahasiswa" value="0">

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <!-- Modal Konfirmasi Alpine.js -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" x-cloak>
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h1 class="text-center font-bold text-xl">Konfirmasi Pembuatan Mahasiswa</h1>
            <p class="text-center mt-3">Apakah Anda ingin membuat data mahasiswa secara otomatis?</p>

            <div class="text-center mt-4">
                <button id="confirmYes" @click="document.getElementById('auto_create_mahasiswa').value = '1'; showModal = false; $el.closest('form').submit();" class="bg-green-500 text-white px-4 py-2 rounded">Ya</button>
                <button @click="document.getElementById('auto_create_mahasiswa').value = '0'; showModal = false; $el.closest('form').submit();" class="bg-red-500 text-white px-4 py-2 rounded">Tidak</button>
            </div>
        </div>
    </div>
</div>
@endsection
