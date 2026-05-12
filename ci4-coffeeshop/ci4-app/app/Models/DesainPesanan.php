<?php

namespace App\Models;

use CodeIgniter\Model;

class DesainPesanan extends Model
{
    // Nama tabel sesuai di phpMyAdmin
    protected $table = 'desain_pesanan'; 

    // Primary key sesuai gambar struktur
    protected $primaryKey = 'id'; 

    // Kolom yang boleh diisi (field di tabel desain_pesanan)
    protected $allowedFields = ['id_pesanan', 'file_desain_url', 'keterangan', 'tanggal_upload']; 

    // Karena tabel ini menggunakan 'tanggal_upload', kita tidak menggunakan 
    // fitur default useTimestamps (created_at/updated_at)
    protected $useTimestamps = false;
}