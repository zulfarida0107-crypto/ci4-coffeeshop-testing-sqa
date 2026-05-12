<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\User;

class UserControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate  = true;
    protected $refresh  = true;
    protected $seed     = 'App\Database\Seeds\UserTableSeeder';
    protected $namespace = 'App';

    public function testIndexShowsList()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/user');
        $result->assertStatus(200);
        $result->assertSee('Manajemen User');
    }

    public function testAddPage()
    {
        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/user/add');
        $result->assertStatus(200);
        $result->assertSee('Tambah User Baru');
    }

    public function testStoreUser()
    {
        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'username'     => 'newuser',
            'password'     => 'pass123',
            'nama_lengkap' => 'New User',
            'role'         => 'karyawan',
        ];
        $result = $this->withSession($session)->post('/user/store', $postData);
        $result->assertRedirectTo('/user');
        $this->seeInDatabase('user', ['username' => 'newuser']);
    }

    public function testEditPage()
    {
        $model  = new User();
        $record = $model->where('username', 'karyawan01')->first();
        $this->assertNotNull($record);

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/user/edit/' . $record['id']);
        $result->assertStatus(200);
        $result->assertSee('Edit User: karyawan01');
    }

    public function testUpdateRedirectsAfterUpdate()
    {
        $model  = new User();
        $record = $model->where('username', 'karyawan01')->first();
        $this->assertNotNull($record);

        $session  = ['logged_in' => true, 'role' => 'admin'];
        $postData = [
            'username'     => 'karyawan01',
            'nama_lengkap' => 'Budi Barista Updated',
            'role'         => 'karyawan',
        ];
        $result = $this->withSession($session)->post('/user/update/' . $record['id'], $postData);
        $result->assertRedirectTo(base_url('user'));
        $this->seeInDatabase('user', ['id' => $record['id'], 'nama_lengkap' => 'Budi Barista Updated']);
    }

    public function testDestroyDeletesRecord()
    {
        $model = new User();
        $model->insert([
            'username'     => 'hapususer99',
            'password'     => password_hash('test', PASSWORD_DEFAULT),
            'nama_lengkap' => 'User Hapus Test',
            'role'         => 'karyawan',
        ]);
        $record = $model->where('username', 'hapususer99')->first();
        $this->assertNotNull($record);

        $session = ['logged_in' => true, 'role' => 'admin'];
        $result  = $this->withSession($session)->get('/user/destroy/' . $record['id']);
        $result->assertRedirect();
        $this->dontSeeInDatabase('user', ['id' => $record['id']]);
    }
}
