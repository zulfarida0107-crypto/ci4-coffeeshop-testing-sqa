<?php

namespace Tests\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\User;

class UserDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\UserTableSeeder';
    protected $namespace = 'App';

    public function testInsertUser()
    {
        $model = new User();
        
        $data = [
            'username'     => 'testuser',
            'password'     => password_hash('password', PASSWORD_DEFAULT),
            'nama_lengkap' => 'Test User',
            'role'         => 'karyawan'
        ];

        $model->insert($data);
        
        $this->seeInDatabase('user', ['username' => 'testuser']);
    }

    public function testSeederWorks()
    {
        $this->seeInDatabase('user', ['username' => 'admin']);
    }
}
