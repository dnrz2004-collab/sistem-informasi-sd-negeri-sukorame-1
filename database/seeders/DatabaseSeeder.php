<?php
namespace Database\Seeders;

use App\Models\{User, Kelas, Guru, Siswa};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Sekolah', 'email' => 'admin@sdn1.sch.id',
            'password' => Hash::make('password'), 'role' => 'admin',
        ]);

        // Guru
        $guru1 = User::create([
            'name' => 'Budi Santoso', 'email' => 'budi@sdn1.sch.id',
            'password' => Hash::make('password'), 'role' => 'guru',
        ]);
        Guru::create(['user_id' => $guru1->id, 'nip' => '198001012005011001',
                       'mata_pelajaran' => 'Matematika']);

        // Kelas
        $kelas = Kelas::create([
            'nama_kelas' => '4A', 'tingkat' => 4,
            'rombel' => 'A', 'wali_kelas_id' => $guru1->id,
        ]);

        // Siswa
        $userSiswa = User::create([
            'name' => 'Andi Saputra', 'email' => 'andi@sdn1.sch.id',
            'password' => Hash::make('password'), 'role' => 'siswa',
        ]);
        Siswa::create([
            'user_id' => $userSiswa->id, 'nisn' => '0123456789',
            'nama_lengkap' => 'Andi Saputra', 'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2015-06-15', 'tempat_lahir' => 'Kediri',
            'alamat' => 'Jl. Sukorame No. 10, Kediri', 'kelas_id' => $kelas->id,
        ]);

        // Wali murid
        User::create([
            'name' => 'Siti Rahayu', 'email' => 'siti@gmail.com',
            'password' => Hash::make('password'), 'role' => 'wali_murid',
        ]);
    }
}