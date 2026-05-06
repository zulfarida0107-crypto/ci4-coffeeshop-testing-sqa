<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false,
                'auto_increment' => true,
            ],
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'id_produk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'status_pesanan' => [
                'type'       => 'ENUM',
                'constraint' => ['Baru', 'Proses', 'Selesai'],
                'default'    => 'Baru',
                'null'       => false,
            ],
            'tanggal_pesanan' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

        // Menjadikan 'id' sebagai Primary Key
        $this->forge->addKey('id', true);

        // Menambahkan Index untuk 'id_produk' agar bisa jadi Foreign Key nantinya
        $this->forge->addKey('id_produk');

        $this->forge->createTable('pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pesanan');
    }
}