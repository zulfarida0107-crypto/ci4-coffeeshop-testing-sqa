<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuProduk extends Model
{
    // Nama tabel sesuai di phpMyAdmin db_kantin2
    protected $table = 'menu_produk'; 

    // Primary key sesuai gambar struktur
    protected $primaryKey = 'id'; 

    // Kolom yang boleh diisi sesuai gambar browse & structure
    protected $allowedFields = [
        'nama_produk', 
        'harga', 
        'deskripsi', 
        'kategori'
    ]; 

    // Tabel menu_produk kamu tidak memiliki kolom created_at/updated_at
    protected $useTimestamps = false;
}