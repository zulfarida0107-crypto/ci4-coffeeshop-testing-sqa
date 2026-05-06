<?php

namespace App\Models;

use CodeIgniter\Model;

class Pesanan extends Model
{
    // 1. Nama tabel di phpMyAdmin adalah 'pesanan'
    protected $table = 'pesanan'; 

    // 2. Primary key adalah 'id'
    protected $primaryKey = 'id'; 

    /**
     * 3. Kolom yang boleh diisi (disesuaikan dengan gambar struktur):
     * id, nama_pelanggan, id_produk, jumlah, total_harga, status_pesanan, tanggal_pesanan
     */
    protected $allowedFields = [
        'nama_pelanggan', 
        'id_produk', 
        'jumlah', 
        'total_harga', 
        'status_pesanan', 
        'tanggal_pesanan'
    ]; 

    // 4. Menggunakan false karena nama kolomnya 'tanggal_pesanan', 
    // bukan standar 'created_at'/'updated_at'
    protected $useTimestamps = false;

    // Opsional: Jika Anda ingin memvalidasi status pesanan (Enum)
    protected $validationRules = [
        'status_pesanan' => 'in_list[Baru,Proses,Selesai]'
    ];
}