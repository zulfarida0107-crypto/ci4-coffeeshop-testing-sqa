<?php

namespace Tests\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\PesanKontak;

class PesanKontakDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\PesanKontakTableSeeder';
    protected $namespace = 'App';

    public function testInsertPesanKontak()
    {
        $model = new PesanKontak();
        
        $data = [
            'nama'            => 'Test User',
            'email'           => 'test@example.com',
            'subjek'          => 'Test Subject',
            'pesan'           => 'Test Message',
            'tanggal_dikirim' => date('Y-m-d H:i:s')
        ];

        $model->insert($data);
        
        $this->seeInDatabase('pesan_kontak', ['nama' => 'Test User']);
    }

    public function testSeederWorks()
    {
        $this->seeInDatabase('pesan_kontak', ['nama' => 'Budi Santoso']);
    }
}
