<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('user', 'kelas')->get();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        // Fetch classes that do not have a dosen assigned
        $kelases = Kelas::doesntHave('dosen')->get();
        return view('dosen.create', compact('kelases'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'kode_dosen' => 'required|unique:dosen',
            'nip' => 'required|unique:dosen',
            'name' => 'required',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        // Buat user
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),  // Gunakan Hash::make
            'role' => 'dosen',
        ]);

        // Buat dosen
        Dosen::create([
            'user_id' => $user->id,
            'kode_dosen' => $data['kode_dosen'],
            'nip' => $data['nip'],
            'name' => $data['name'],
            'kelas_id' => $data['kelas_id'],
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'username' => 'required|unique:users,username,' . $dosen->user->id,
            'email' => 'required|email|unique:users,email,' . $dosen->user->id,
            'password' => 'nullable|min:6',
            'kode_dosen' => 'required|unique:dosen,kode_dosen,' . $dosen->id,
            'nip' => 'required|unique:dosen,nip,' . $dosen->id,
            'name' => 'required',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        // Update user
        $user = $dosen->user;
        $user->username = $data['username'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);  // Hashing password saat update
        }
        $user->save();

        // Update dosen
        $dosen->update([
            'kode_dosen' => $data['kode_dosen'],
            'nip' => $data['nip'],
            'name' => $data['name'],
            'kelas_id' => $data['kelas_id'],
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate');
    }
    // DosenController.php

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        // Fetch classes that do not have a dosen assigned, excluding the current class
        $kelases = Kelas::doesntHave('dosen')->orWhere('id', $dosen->kelas_id)->get();
        return view('dosen.edit', compact('dosen', 'kelases'));
    }


    public function destroy(Dosen $dosen)
    {
        $dosen->user->delete(); // Hapus user dan dosen karena onDelete('cascade')
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}
