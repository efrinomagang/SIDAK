<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = Kelas::all();
        return view('kelas.index', compact('kelases'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Buat kelas dengan memasukkan name dan jumlah
        $kelas = Kelas::create([
            'name' => $data['name'],
            'jumlah' => $data['jumlah'], // Masukkan nilai jumlah
        ]);

        // Cek apakah Kaprodi ingin membuat mahasiswa otomatis
        if ($request->input('auto_create_mahasiswa') == '1') {
            $this->createMahasiswaOtomatis($kelas, $data['jumlah']);
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas dan mahasiswa berhasil dibuat');
    }

    private function createMahasiswaOtomatis(Kelas $kelas, $jumlahMahasiswa)
    {
        for ($i = 1; $i <= $jumlahMahasiswa; $i++) {
            // Generate nama, username, email, dan password otomatis
            $name = 'Mahasiswa ' . ($kelas->mahasiswas()->count() + 1); // Update to add unique name
            $username = 'mhs' . uniqid();
            $email = $username . '@example.com';
            $password = bcrypt('password123'); // password default

            // Buat user terlebih dahulu
            $user = \App\Models\User::create([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => 'mahasiswa',
            ]);

            // Setelah user dibuat, buat mahasiswa dengan kelas_id yang sama
            Mahasiswa::create([
                'user_id' => $user->id,
                'kelas_id' => $kelas->id,
                'nim' => rand(100000, 999999), // generate nim secara acak
                'name' => $name,
                'tempat_lahir' => 'Tempat',
                'tanggal_lahir' => now(),
                'edit' => false, // set edit sebagai false
            ]);
        }
    }

    private function removeExcessMahasiswa(Kelas $kelas, $jumlahMahasiswa)
    {
        // Ambil mahasiswa yang harus dihapus
        $mahasiswas = $kelas->mahasiswas()->take($jumlahMahasiswa)->get();

        foreach ($mahasiswas as $mahasiswa) {
            // Hapus mahasiswa terkait
            $mahasiswa->user()->delete(); // Hapus data user
            $mahasiswa->delete(); // Hapus data mahasiswa
        }
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil jumlah mahasiswa sebelumnya
        $previousJumlah = $kelas->jumlah;

        // Update data kelas
        $kelas->update($data);

        // Cek perubahan jumlah mahasiswa
        if ($data['jumlah'] > $previousJumlah) {
            // Tambah mahasiswa
            $this->createMahasiswaOtomatis($kelas, $data['jumlah'] - $previousJumlah);
        } elseif ($data['jumlah'] < $previousJumlah) {
            // Hapus mahasiswa yang melebihi jumlah
            $this->removeExcessMahasiswa($kelas, $previousJumlah - $data['jumlah']);
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate');
    }
    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
