<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesanKontak extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'subjek' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'pesan' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tanggal_dikirim' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pesan_kontak', true);

    }

    public function down()
    {
        $this->forge->dropTable('pesan_kontak');
    }
}