<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kaprodi;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat Kaprodi
        $kaprodiUser = User::create([
            'username' => 'kaprodi1',
            'email' => 'kaprodi1@example.com',
            'password' => bcrypt('password'),
            'role' => 'kaprodi',
        ]);

        Kaprodi::create([
            'user_id' => $kaprodiUser->id,
            'kode_dosen' => 1001,
            'nip' => 1234567890,
            'name' => 'Kaprodi 1',
        ]);

        // Buat Kelas
        $kelas1 = Kelas::create([
            'name' => 'Kelas A',
            'jumlah' => 10,
        ]);

        $kelas2 = Kelas::create([
            'name' => 'Kelas B',
            'jumlah' => 10,
        ]);

        // Buat Dosen Wali
        $dosenWali1User = User::create([
            'username' => 'dosenwali1',
            'email' => 'dosenwali1@example.com',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $dosenWali1User->id,
            'kode_dosen' => 'D1001',
            'nip' => 'NIP1001',
            'name' => 'Dosen Wali 1',
            'kelas_id' => $kelas1->id,
        ]);

        $dosenWali2User = User::create([
            'username' => 'dosenwali2',
            'email' => 'dosenwali2@example.com',
            'password' => bcrypt('password'),
            'role' => 'dosen',
        ]);

        Dosen::create([
            'user_id' => $dosenWali2User->id,
            'kode_dosen' => 'D1002',
            'nip' => 'NIP1002',
            'name' => 'Dosen Wali 2',
            'kelas_id' => $kelas2->id,
        ]);

        // Buat Dosen Biasa
        for ($i = 3; $i <= 5; $i++) {
            $dosenUser = User::create([
                'username' => 'dosen' . $i,
                'email' => 'dosen' . $i . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'user_id' => $dosenUser->id,
                'kode_dosen' => 'D10' . $i,
                'nip' => 'NIP10' . $i,
                'name' => 'Dosen ' . $i,
                'kelas_id' => null, // Dosen biasa
            ]);
        }

        // Buat Mahasiswa
        for ($k = 1; $k <= 2; $k++) { // 2 kelas
            $kelas = $k == 1 ? $kelas1 : $kelas2;
            for ($m = 1; $m <= 10; $m++) { // 10 mahasiswa per kelas
                $user = User::create([
                    'username' => 'mahasiswa' . $k . $m,
                    'email' => 'mahasiswa' . $k . $m . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'mahasiswa',
                ]);

                Mahasiswa::create([
                    'user_id' => $user->id,
                    'kelas_id' => $kelas->id,
                    'nim' => 2000 + $k * 100 + $m,
                    'name' => 'Mahasiswa ' . $k . $m,
                    'tempat_lahir' => 'Kota ' . $k . $m,
                    'tanggal_lahir' => '2000-01-01',
                    'edit' => false,
                ]);
            }
        }
    }
}
