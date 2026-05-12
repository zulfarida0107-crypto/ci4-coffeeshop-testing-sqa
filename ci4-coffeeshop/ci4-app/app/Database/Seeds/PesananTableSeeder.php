<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PesananTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pelanggan'  => 'Rudi Hermawan',
                'id_produk'       => 1,
                'jumlah'          => 2,
                'total_harga'     => 50000.00,
                'status_pesanan'  => 'Proses',
                'tanggal_pesanan' => '2026-02-23 14:46:33',
            ],
            [
                'nama_pelanggan'  => 'Siti Nurhaliza',
                'id_produk'       => 2,
                'jumlah'          => 1,
                'total_harga'     => 35000.00,
                'status_pesanan'  => 'Selesai',
                'tanggal_pesanan' => '2026-02-23 14:46:33',
            ],
            [
                'nama_pelanggan'  => 'Joko Widodo',
                'id_produk'       => 3,
                'jumlah'          => 1,
                'total_harga'     => 40000.00,
                'status_pesanan'  => 'Baru',
                'tanggal_pesanan' => '2026-02-23 14:46:33',
            ],
        ];

        // Memasukkan data ke tabel pesanan
        $this->db->table('pesanan')->insertBatch($data);
    }
}