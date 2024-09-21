<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\RequestEdit;

class RequestEditController extends Controller
{
    // Display the list of edit requests for the Dosen
    public function index()
    {
        $dosen = auth()->user()->dosen;

        // Get requests from students in the same class
        if ($dosen->kelas_id) {
            $editRequests = RequestEdit::whereHas('mahasiswa', function ($query) use ($dosen) {
                $query->where('kelas_id', $dosen->kelas_id);
            })->get();

            return view('mahasiswa.edit-requests', compact('editRequests'));
        }

        return redirect()->route('kelas.index')->with('error', 'Anda tidak memiliki akses untuk mengelola permintaan edit.');
    }

    public function approve(Request $request, RequestEdit $editRequest)
    {
        $dosen = auth()->user()->dosen;

        // Ensure the request belongs to the Dosen's class
        if ($dosen->kelas_id == $editRequest->mahasiswa->kelas_id) {
            if ($editRequest->status == 'Pending') {
                $editRequest->status = 'Disetujui';
                $editRequest->save();

                // Unlock mahasiswa editing
                $mahasiswa = $editRequest->mahasiswa;
                $mahasiswa->edit = 1;  // Allow mahasiswa to edit their profile
                $mahasiswa->save();

                return redirect()->route('mahasiswa.edit-requests')->with('success', 'Permintaan edit disetujui.');
            }
        }

        return redirect()->route('kelas.index')->with('error', 'Anda tidak memiliki akses untuk menyetujui permintaan edit.');
    }

    public function reject(Request $request, RequestEdit $editRequest)
    {
        $dosen = auth()->user()->dosen;

        // Ensure the request belongs to the Dosen's class
        if ($dosen->kelas_id == $editRequest->mahasiswa->kelas_id) {
            if ($editRequest->status == 'Pending') {
                $editRequest->status = 'Ditolak';
                $editRequest->save();

                return redirect()->route('mahasiswa.edit-requests')->with('success', 'Permintaan edit ditolak.');
            }
        }

        return redirect()->route('kelas.index')->with('error', 'Anda tidak memiliki akses untuk menolak permintaan edit.');
    }
};
