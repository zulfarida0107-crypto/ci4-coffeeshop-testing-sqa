<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\PesanKontak;

class PesanKontakControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate  = true;
    protected $refresh  = true;
    protected $seed     = 'App\Database\Seeds\PesanKontakTableSeeder';
    protected $namespace = 'App';

    // =========================================================
    // READ — Index & Show
    // =========================================================

    public function testIndexShowsList()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesan-kontak');

        $result->assertStatus(200);
        // Sesuai view list.php baris 8: <h1>Daftar Pesan Masuk</h1>
        $result->assertSee('Daftar Pesan Masuk');
    }

    public function testShowPage()
    {
        $model  = new PesanKontak();
        $record = $model->where('nama', 'Budi Santoso')->first();
        $this->assertNotNull($record, 'Seeder harus menyediakan minimal 1 baris.');

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesan-kontak/show/' . $record['id']);

        $result->assertStatus(200);
        // Sesuai view show.php baris 9: <h1>Dari: esc($result['nama'])</h1>
        $result->assertSee('Dari: Budi Santoso');
    }

    // =========================================================
    // CREATE — Store (PesanKontak tidak punya halaman add admin,
    //           store digunakan dari frontend/user)
    // =========================================================

    public function testStorePesan()
    {
        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'nama'   => 'Guest',
            'email'  => 'guest@example.com',
            'subjek' => 'Hello',
            'pesan'  => 'Just testing',
        ];

        $result = $this->withSession($session)->post('/pesan-kontak/store', $postData);

        // Controller store() redirect ke '/pesan-kontak'
        $result->assertRedirectTo('/pesan-kontak');
        $this->seeInDatabase('pesan_kontak', ['nama' => 'Guest']);
    }

    // =========================================================
    // DELETE — Destroy
    // =========================================================

    public function testDestroyDeletesRecord()
    {
        // Insert data sementara untuk dihapus
        $model = new PesanKontak();
        $model->insert([
            'nama'            => 'Hapus Pesan Test',
            'email'           => 'hapus@example.com',
            'subjek'          => 'Test Hapus',
            'pesan'           => 'Pesan ini akan dihapus',
            'tanggal_dikirim' => date('Y-m-d H:i:s'),
        ]);
        $record = $model->where('nama', 'Hapus Pesan Test')->first();
        $this->assertNotNull($record);

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/pesan-kontak/destroy/' . $record['id']);

        $result->assertRedirect();
        $this->dontSeeInDatabase('pesan_kontak', ['id' => $record['id']]);
    }
}
