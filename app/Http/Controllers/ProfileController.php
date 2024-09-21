<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Models\RequestEdit;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())
                              ->with('kelas')
                              ->first();
        return view('profile.index', compact('mahasiswa'));
    }

    public function edit()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Check if editing is allowed
        if ($mahasiswa->edit === 0) {
            return redirect()->route('profile.index')->with('error', 'Profile edit is locked. Please wait for approval from your supervisor.');
        }

        return view('profile.edit', compact('mahasiswa'));
    }

    public function update(Request $request)
{
    $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
    $user = User::where('id', Auth::id())->first();

    // Check if editing is allowed
    if ($mahasiswa->edit === 0) {
        return redirect()->route('profile.index')->with('error', 'Fitur Edit masih terkunci. Tunggu Persetujuan dari Wali Kelas Anda');
    }

    // Validate and update User data
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }
    $user->save();

    // Update the Mahasiswa record
    $mahasiswa->update($request->only('name', 'nim','tempat_lahir', 'tanggal_lahir'));

    // Reset the edit status
    $mahasiswa->edit = 0;
    $mahasiswa->save();

    // Update the request edit status if any
    $requestEdit = RequestEdit::where('mahasiswa_id', $mahasiswa->id)
                              ->where('status', 'pending')
                              ->first();

    if ($requestEdit) {
        $requestEdit->status = 'approved';
        $requestEdit->save();
    }

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
}


    public function requestEdit()
    {
        return view('profile.request-edit');
    }

    public function storeRequestEdit(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        // Check if there's a pending request
        if (RequestEdit::where('mahasiswa_id', $mahasiswa->id)->where('status', 'pending')->exists()) {
            return redirect()->route('profile.index')->with('error', 'Anda sudah memiliki permintaan yang belum diproses.');
        }


        // Create a new request edit record
        RequestEdit::create([
            'kelas_id' => $mahasiswa->kelas_id,
            'mahasiswa_id' => $mahasiswa->id,
            'keterangan' => $request->input('edit_request'),
            'status' => 'pending'
        ]);

        return redirect()->route('profile.index')->with('success', 'Edit request submitted successfully.');
    }
}
