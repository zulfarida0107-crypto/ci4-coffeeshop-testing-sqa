<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DesainPesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => false, // Sesuai gambar: Int(11)
                'auto_increment' => true,
            ],
            'id_pesanan' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'file_desain_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal_upload' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

        // Menambahkan Primary Key pada kolom 'id'
        $this->forge->addKey('id', true);
        
        // Menambahkan Index pada 'id_pesanan' seperti yang ada di gambar (BTREE)
        $this->forge->addKey('id_pesanan');

        $this->forge->createTable('desain_pesanan');
    }

    public function down()
    {
        $this->forge->dropTable('desain_pesanan');
    }
}