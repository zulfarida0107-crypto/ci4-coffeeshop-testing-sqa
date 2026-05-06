<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserTableSeeder extends Seeder
{
 public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'password'     => password_hash('test', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Super Admin',
                'role'         => 'admin',
            ],
            [
                'username'     => 'karyawan01',
                'password'     => password_hash('test123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Budi Barista',
                'role'         => 'karyawan',
            ],
            [
                'username'     => 'customer01',
                'password'     => password_hash('test123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Andi Pelanggan',
                'role'         => 'user',
            ],
        ];

        // Memasukkan data ke tabel user
        $this->db->table('user')->insertBatch($data);
    }
}