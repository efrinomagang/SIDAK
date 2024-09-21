@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Requests</h1>

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Mahasiswa</th>
                <th class="py-2 px-4 border-b">Request</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($editRequests as $request)
            <tr>
                <td class="py-2 px-4 border-b">{{ $request->mahasiswa->name }}</td>
                <td class="py-2 px-4 border-b">{{ $request->keterangan }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($request->status) }}</td>
                <td class="py-2 px-4 border-b">
                    @if(strtolower($request->status) === 'pending')
    <form action="{{ route('mahasiswa.edit-requests.approve', $request) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
    </form>

    <form action="{{ route('mahasiswa.edit-requests.reject', $request) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
    </form>
@else
    <span class="text-gray-500">{{ ucfirst($request->status) }}</span>
@endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
