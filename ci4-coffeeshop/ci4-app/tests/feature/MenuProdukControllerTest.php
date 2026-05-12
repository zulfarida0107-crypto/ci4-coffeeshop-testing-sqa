<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MenuProduk;

class MenuProdukControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate  = true;
    protected $refresh  = true;
    protected $seed     = 'App\Database\Seeds\MenuProdukTableSeeder';
    protected $namespace = 'App';

    // =========================================================
    // READ — Index & Show
    // =========================================================

    public function testIndexShowsMenuPage()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/menu-produk');

        $result->assertStatus(200);
        // Sesuai view list.php baris 8: <h1>Daftar Menu Produk</h1>
        $result->assertSee('Daftar Menu Produk');
    }

    public function testShowPage()
    {
        $model  = new MenuProduk();
        $record = $model->where('nama_produk', 'Kopi Kenangan Mantan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/menu-produk/show/' . $record['id']);

        $result->assertStatus(200);
        // Sesuai view show.php baris 9: <h1>esc($result['nama_produk'])</h1>
        $result->assertSee('Kopi Kenangan Mantan');
    }

    // =========================================================
    // CREATE — Add page & Store
    // =========================================================

    public function testAddPage()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/menu-produk/add');

        $result->assertStatus(200);
        // Sesuai view add.php baris 9: <h1>Tambah Daftar Menu</h1>
        $result->assertSee('Tambah Daftar Menu');
    }

    public function testAddMenu()
    {
        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'nama_produk' => 'New Coffee',
            'harga'       => 25000,
            'deskripsi'   => 'Good coffee',
            'kategori'    => 'Kopi',
        ];

        $result = $this->withSession($session)->post('/menu-produk/store', $postData);

        // Controller store() redirect ke base_url('menu-produk')
        $result->assertRedirectTo(base_url('menu-produk'));
        $this->seeInDatabase('menu_produk', ['nama_produk' => 'New Coffee']);
    }

    // =========================================================
    // UPDATE — Edit page & Update
    // =========================================================

    public function testEditPage()
    {
        $model  = new MenuProduk();
        $record = $model->where('nama_produk', 'Kopi Kenangan Mantan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/menu-produk/edit/' . $record['id']);

        $result->assertStatus(200);
        // Sesuai view edit.php baris 9: <h1>Edit Menu Produk</h1>
        $result->assertSee('Edit Menu Produk');
    }

    public function testUpdateRedirectsAfterUpdate()
    {
        $model  = new MenuProduk();
        $record = $model->where('nama_produk', 'Kopi Kenangan Mantan')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'nama_produk' => 'Kopi Kenangan Mantan Updated',
            'harga'       => 27000,
            'deskripsi'   => 'Updated description',
            'kategori'    => 'Kopi',
        ];

        $result = $this->withSession($session)->post('/menu-produk/update/' . $record['id'], $postData);

        $result->assertRedirectTo(base_url('menu-produk'));
        $this->seeInDatabase('menu_produk', [
            'id'          => $record['id'],
            'nama_produk' => 'Kopi Kenangan Mantan Updated',
        ]);
    }

    // =========================================================
    // DELETE — Destroy
    // =========================================================

    public function testDestroyDeletesRecord()
    {
        // Insert data sementara untuk dihapus
        $model = new MenuProduk();
        $model->insert([
            'nama_produk' => 'Menu Hapus Test',
            'harga'       => 15000,
            'deskripsi'   => 'Untuk dihapus',
            'kategori'    => 'Non-Kopi',
        ]);
        $record = $model->where('nama_produk', 'Menu Hapus Test')->first();
        $this->assertNotNull($record);

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/menu-produk/destroy/' . $record['id']);

        $result->assertRedirect();
        $this->dontSeeInDatabase('menu_produk', ['id' => $record['id']]);
    }
}