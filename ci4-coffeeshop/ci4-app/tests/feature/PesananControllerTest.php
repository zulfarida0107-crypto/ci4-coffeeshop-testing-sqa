<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\Pesanan;
use App\Models\MenuProduk;

class PesananControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate  = true;
    protected $refresh  = true;
    protected $seed     = 'App\Database\Seeds\PesananTableSeeder';
    protected $namespace = 'App';

    // =========================================================
    // READ — Index & Show
    // =========================================================

    public function testIndexShowsList()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesanan');

        $result->assertStatus(200);
        // Sesuai view list.php baris 8: <h1>Daftar Pesanan Masuk</h1>
        $result->assertSee('Daftar Pesanan Masuk');
    }

    public function testShowPage()
    {
        $model  = new Pesanan();
        $record = $model->where('nama_pelanggan', 'Rudi Hermawan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesanan/show/' . $record['id']);

        $result->assertStatus(200);
        // Sesuai view show.php baris 9: <h1>Pesanan #esc($result['id'])</h1>
        $result->assertSee('Pesanan #');
    }

    // =========================================================
    // CREATE — Add page & Store
    // =========================================================

    public function testAddPage()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesanan/add');

        $result->assertStatus(200);
        // Sesuai view add.php baris 11: <h1>Tambah Pesanan Baru</h1>
        $result->assertSee('Tambah Pesanan Baru');
    }

    public function testStorePesanan()
    {
        $session  = ['logged_in' => true, 'role' => 'admin'];
        // Controller store() menerima id_produk[] dan jumlah[] sebagai array
        $postData = [
            'nama_pelanggan' => 'Andi Pelanggan',
            'id_produk'      => [1],
            'jumlah'         => [2],
            'total_harga'    => 50000,
            'status_pesanan' => 'Baru',
        ];

        $result = $this->withSession($session)->post('/pesanan/store', $postData);

        $result->assertRedirectTo(base_url('pesanan'));
        $this->seeInDatabase('pesanan', ['nama_pelanggan' => 'Andi Pelanggan']);
    }

    // =========================================================
    // UPDATE — Edit page & Update
    // =========================================================

    public function testEditPage()
    {
        $model  = new Pesanan();
        $record = $model->where('nama_pelanggan', 'Rudi Hermawan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesanan/edit/' . $record['id']);

        $result->assertStatus(200);
        // Sesuai view edit.php baris 9: <h1>Edit Pesanan</h1>
        $result->assertSee('Edit Pesanan');
    }

    public function testUpdateRedirectsAfterUpdate()
    {
        $model  = new Pesanan();
        $record = $model->where('nama_pelanggan', 'Rudi Hermawan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'nama_pelanggan' => 'Rudi Hermawan Updated',
            'id_produk'      => 1,
            'jumlah'         => 3,
            'total_harga'    => 75000,
            'status_pesanan' => 'Selesai',
        ];

        $result = $this->withSession($session)->post('/pesanan/update/' . $record['id'], $postData);

        $result->assertRedirectTo(base_url('pesanan'));
        $this->seeInDatabase('pesanan', [
            'id'             => $record['id'],
            'status_pesanan' => 'Selesai',
        ]);
    }

    // =========================================================
    // DELETE — Destroy
    // =========================================================

    public function testDestroyDeletesRecord()
    {
        // Insert data sementara untuk dihapus
        $model = new Pesanan();
        $model->insert([
            'nama_pelanggan'  => 'Hapus User Test',
            'id_produk'       => 1,
            'jumlah'          => 1,
            'total_harga'     => 25000,
            'status_pesanan'  => 'Baru',
            'tanggal_pesanan' => date('Y-m-d H:i:s'),
        ]);
        $record = $model->where('nama_pelanggan', 'Hapus User Test')->first();
        $this->assertNotNull($record);

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesanan/destroy/' . $record['id']);

        $result->assertRedirect();
        $this->dontSeeInDatabase('pesanan', ['id' => $record['id']]);
    }
}
