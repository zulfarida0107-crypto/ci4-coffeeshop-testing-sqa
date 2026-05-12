<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanKontak extends Model
{
    protected $table = 'pesan_kontak';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'email',
        'subjek',
        'pesan',
        'tanggal_dikirim'
    ];

    protected $useTimestamps = false;
}