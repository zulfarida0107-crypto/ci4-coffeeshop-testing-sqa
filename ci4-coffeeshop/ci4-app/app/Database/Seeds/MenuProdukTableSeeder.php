<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuProdukTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_produk' => 'Kopi Kenangan Mantan',
                'harga'       => 25000.00,
                'deskripsi'   => 'Racikan kopi nusantara dengan sentuhan karamel dan...',
                'kategori'    => 'Kopi',
            ],
            [
                'nama_produk' => 'Caramel Macchiato',
                'harga'       => 35000.00,
                'deskripsi'   => 'Espresso dengan susu segar dan saus karamel',
                'kategori'    => 'Kopi',
            ],
            [
                'nama_produk' => 'Avocado Coffee',
                'harga'       => 40000.00,
                'deskripsi'   => 'Perpaduan creamy alpukat dengan kopi yang kuat',
                'kategori'    => 'Non-Kopi',
            ],
            [
                'nama_produk' => 'Pandan Brew',
                'harga'       => 30000.00,
                'deskripsi'   => 'Susu pandan dengan espresso shot',
                'kategori'    => 'Non-Kopi',
            ],
            [
                'nama_produk' => 'Chocolate Croissant',
                'harga'       => 28000.00,
                'deskripsi'   => 'Pastry berlapis dengan isian cokelat premium',
                'kategori'    => 'Pastry',
            ],
            [
                'nama_produk' => 'Almond Croissant',
                'harga'       => 30000.00,
                'deskripsi'   => 'Croissant renyah dengan topping almond dan gula',
                'kategori'    => 'Pastry',
            ],
        ];

        // Menggunakan insertBatch untuk memasukkan banyak data sekaligus
        $this->db->table('menu_produk')->insertBatch($data);
    }
}