<?php
namespace Tests\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\DesainPesanan;

class DesainPesananDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\DesainPesananTableSeeder';
    protected $namespace = 'App';

    public function testInsertDesainPesanan()
    {
        $model = new DesainPesanan();
        $data = [
            'id_pesanan'      => 5,
            'file_desain_url' => 'https://link-gambar-test.com/kue.jpg',
            'keterangan'      => 'Kue tema bunga',
            'tanggal_upload'  => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);
        $this->seeInDatabase('desain_pesanan', ['id_pesanan' => 5]);
    }

    public function testSeederWorks()
    {
        // Sesuaikan dengan ID pesanan yang ada di Seeder (id_pesanan => 1)
        $this->seeInDatabase('desain_pesanan', ['id_pesanan' => 1]);
    }
}