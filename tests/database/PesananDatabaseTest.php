<?php

namespace Tests\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\Pesanan;

class PesananDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\PesananTableSeeder';
    protected $namespace = 'App';

    public function testInsertPesanan()
    {
        $model = new Pesanan();
        
        $data = [
            'nama_pelanggan'  => 'Test Pelanggan',
            'id_produk'       => 1,
            'jumlah'          => 1,
            'total_harga'     => 25000,
            'status_pesanan'  => 'Baru',
            'tanggal_pesanan' => date('Y-m-d H:i:s')
        ];

        $model->insert($data);
        
        $this->seeInDatabase('pesanan', ['nama_pelanggan' => 'Test Pelanggan']);
    }

    public function testSeederWorks()
    {
        $this->seeInDatabase('pesanan', ['nama_pelanggan' => 'Rudi Hermawan']);
    }
}
