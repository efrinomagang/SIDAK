<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $dosen = auth()->user()->dosen;

        if ($dosen->kelas_id) {
            // Retrieve mahasiswas sorted by nim in ascending order
            $mahasiswas = Mahasiswa::where('kelas_id', $dosen->kelas_id)
                ->orderBy('nim', 'asc')
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                          ->orWhere('nim', 'like', '%' . $request->search . '%');
                })
                ->get();

            return view('mahasiswa.index', compact('mahasiswas'));
        }

        return redirect()->route('kelas.index')->with('error', 'Anda tidak memiliki akses untuk mengelola mahasiswa.');
    }

    public function create()
    {
        $kelases = Kelas::all();
        return view('mahasiswa.create', compact('kelases'));
    }

    public function store(Request $request)
{
    // Validate the incoming request
    $data = $request->validate([
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'nim' => 'required|unique:mahasiswa',
        'name' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'kelas_id' => 'nullable|exists:kelas,id',
    ]);

    // Check if a class was selected
    if ($data['kelas_id']) {
        // Get the class by ID
        $kelas = Kelas::find($data['kelas_id']);

        // Check if the class exists
        if ($kelas) {
            // Count the current number of students in the class
            $currentStudentCount = $kelas->mahasiswas->count();

            // Check if adding one more student exceeds the maximum capacity
            if ($currentStudentCount >= $kelas->jumlah) {
                // Redirect back with an error message
                return redirect()->back()->withErrors([
                    'kelas_id' => 'Jumlah mahasiswa di kelas ini sudah mencapai batas maksimum.'
                ])->withInput();
            }
        }
    }

    // Create the user
    $user = User::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),  // Hash the password
        'role' => 'mahasiswa',  // Set role to 'mahasiswa'
    ]);

    // Create the mahasiswa
    Mahasiswa::create([
        'user_id' => $user->id,  // Link mahasiswa to the created user
        'nim' => $data['nim'],
        'name' => $data['name'],
        'tempat_lahir' => $data['tempat_lahir'],
        'tanggal_lahir' => $data['tanggal_lahir'],
        'kelas_id' => $data['kelas_id'],
    ]);

    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
}

    public function edit(Mahasiswa $mahasiswa)
    {
        $kelases = Kelas::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelases'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate([
            'username' => 'required|unique:users,username,' . $mahasiswa->user->id,
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user->id,
            'password' => 'nullable|min:6',
            'name' => 'required',
        ]);

        // Update user information
        $user = $mahasiswa->user;
        $user->username = $data['username'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        // Update mahasiswa information
        $mahasiswa->update([
            'name' => $data['name'],
            // Update other mahasiswa fields if needed
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }


    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

}
