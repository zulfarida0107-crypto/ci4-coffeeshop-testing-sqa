<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DesainPesananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id_pesanan'      => 1,
                'file_desain_url' => '/uploads/desain_kue_ultah.jpg',
                'keterangan'      => 'Desain kue dengan tema superhero',
                'tanggal_upload'  => '2026-02-23 14:46:33',
            ],
        ];

        // Memasukkan data ke tabel desain_pesanan
        $this->db->table('desain_pesanan')->insertBatch($data);
    }
}