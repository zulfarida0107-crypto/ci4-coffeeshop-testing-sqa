<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuProduk extends Migration
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
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['Kopi', 'Non-Kopi', 'Pastry'],
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('menu_produk', true);

    }

    public function down()
    {
        $this->forge->dropTable('menu_produk');
    }
}