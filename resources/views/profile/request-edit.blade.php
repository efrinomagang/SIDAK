@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Permintaan Edit Data</h1>

    <form action="{{ route('profile.store-request-edit') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="edit_request" class="block text-sm font-medium">Permintaan Edit</label>
            <textarea name="edit_request" id="edit_request" rows="4" class="form-textarea mt-1 block w-full" required></textarea>
        </div>

        @php
            use App\Models\RequestEdit;
            $mahasiswaId = Auth::user()->mahasiswa->id;
            $hasPendingRequest = RequestEdit::where('mahasiswa_id', $mahasiswaId)
                                            ->where('status', 'pending')
                                            ->exists();
        @endphp

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded"
            @if($hasPendingRequest) disabled title="Anda sudah memiliki permintaan yang belum diproses." @endif>
            Kirim Permintaan
        </button>
    </form>
</div>

@if($hasPendingRequest)
    <div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('Anda memiliki permintaan aktif, silahkan hubungi wali dosen Anda.');
            });
        </script>
    </div>
@endif
@endsection
