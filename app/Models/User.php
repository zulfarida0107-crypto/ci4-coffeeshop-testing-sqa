<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    // 1. Nama tabel sesuai di phpMyAdmin (image_99f67f.jpg)
    protected $table = 'user'; 

    // 2. Primary key sesuai gambar struktur (image_99f6bb.jpg)
    protected $primaryKey = 'id'; 

    /**
     * 3. Kolom yang boleh diisi sesuai gambar struktur tabel user:
     * id, username, password, nama_lengkap, role
     */
    protected $allowedFields = [
        'username', 
        'password', 
        'nama_lengkap', 
        'role'
    ]; 

    // 4. Karena tabel ini tidak memiliki kolom created_at/updated_at
    protected $useTimestamps = false;
}