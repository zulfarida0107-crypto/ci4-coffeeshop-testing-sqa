<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'karyawan', 'user'],
                'default'    => 'user',
                'null'       => false,
            ],
        ]);

        // Menjadikan 'id' sebagai Primary Key
        $this->forge->addKey('id', true);

        // Menambahkan Index Unik untuk 'username' seperti di gambar
        $this->forge->addKey('username', false, true);

        $this->forge->createTable('user', true);

    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}