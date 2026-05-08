<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\DesainPesanan;

class DesainPesananControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate  = true;
    protected $refresh  = true;
    protected $seed     = 'App\Database\Seeds\DesainPesananTableSeeder';
    protected $namespace = 'App';

    // =========================================================
    // READ — Index & Show
    // =========================================================

    public function testIndexShowsList()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/desain-pesanan');

        $result->assertStatus(200);
        $result->assertSee('Daftar Desain Pesanan (Kue)');
    }

    public function testShowPage()
    {
        // Ambil ID yang di-seed oleh DesainPesananTableSeeder (id_pesanan = 1)
        $model  = new DesainPesanan();
        $record = $model->where('id_pesanan', 1)->first();
        $this->assertNotNull($record, 'Seeder harus mengisi minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/desain-pesanan/show/' . $record['id']);

        $result->assertStatus(200);
        $result->assertSee('Desain Pesanan #');
    }

    // =========================================================
    // CREATE — Add page & Store
    // =========================================================

    public function testAddPage()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/desain-pesanan/add');

        $result->assertStatus(200);
        $result->assertSee('Tambah Desain Pesanan Baru');
    }

    public function testStoreRedirectsAfterInsert()
    {
        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'id_pesanan'      => 99,
            'file_desain_url' => 'https://test.com/desain-test.jpg',
            'keterangan'      => 'Test insert via feature test',
        ];

        $result = $this->withSession($session)->post('/desain-pesanan/store', $postData);

        // Setelah store() berhasil, controller redirect ke /desain-pesanan
        $result->assertRedirect();
        $this->seeInDatabase('desain_pesanan', ['id_pesanan' => 99]);
    }

    // =========================================================
    // UPDATE — Edit page & Update
    // =========================================================

    public function testEditPage()
    {
        $model  = new DesainPesanan();
        $record = $model->where('id_pesanan', 1)->first();
        $this->assertNotNull($record, 'Seeder harus mengisi minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/desain-pesanan/edit/' . $record['id']);

        $result->assertStatus(200);
        $result->assertSee('Edit Desain Pesanan #');
    }

    public function testUpdateRedirectsAfterUpdate()
    {
        $model  = new DesainPesanan();
        $record = $model->where('id_pesanan', 1)->first();
        $this->assertNotNull($record, 'Seeder harus mengisi minimal 1 baris.');

        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'id_pesanan'      => 1,
            'file_desain_url' => 'https://updated-link.com/desain-baru.jpg',
            'keterangan'      => 'Keterangan diperbarui via test',
        ];

        $result = $this->withSession($session)->post('/desain-pesanan/update/' . $record['id'], $postData);

        $result->assertRedirect();
        $this->seeInDatabase('desain_pesanan', [
            'id'              => $record['id'],
            'file_desain_url' => 'https://updated-link.com/desain-baru.jpg',
        ]);
    }

    // =========================================================
    // DELETE — Destroy
    // =========================================================

    public function testDestroyDeletesRecord()
    {
        // Insert data sementara untuk dihapus agar seeder tidak terganggu
        $model = new DesainPesanan();
        $model->insert([
            'id_pesanan'      => 77,
            'file_desain_url' => 'https://test.com/hapus.jpg',
            'keterangan'      => 'Data untuk dihapus',
            'tanggal_upload'  => date('Y-m-d H:i:s'),
        ]);
        $record = $model->where('id_pesanan', 77)->first();
        $this->assertNotNull($record, 'Data untuk dihapus harus berhasil dibuat.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/desain-pesanan/destroy/' . $record['id']);

        $result->assertRedirect();
        $this->dontSeeInDatabase('desain_pesanan', ['id' => $record['id']]);
    }
}
