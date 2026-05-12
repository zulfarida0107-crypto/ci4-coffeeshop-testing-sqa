<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PesanKontakTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama'            => 'Budi Santoso',
                'email'           => 'budi@example.com',
                'subjek'          => 'Pertanyaan Menu',
                'pesan'           => 'Apakah ada menu vegetarian?',
                'tanggal_dikirim' => '2026-02-23 14:46:33',
            ],
            [
                'nama'            => 'Siti Nurhaliza',
                'email'           => 'siti@example.com',
                'subjek'          => 'Komentar',
                'pesan'           => 'Makanannya enak-enak, recommended!',
                'tanggal_dikirim' => '2026-02-23 14:46:33',
            ],
        ];

        // Memasukkan data ke tabel pesan_kontak
        $this->db->table('pesan_kontak')->insertBatch($data);
    }
}