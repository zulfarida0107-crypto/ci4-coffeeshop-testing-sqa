<?php

namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class LoginCoffeeShopControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\UserTableSeeder';
    protected $namespace = 'App';

    public function testLoginPageShows()
    {
        $result = $this->get('/login');

        $result->assertStatus(200);
    }

    public function testLoginSuccess()
    {
        $result = $this->post('/login/auth', [
            'username' => 'admin',
            'password' => 'test'
        ]);

        $result->assertRedirectTo('/user');
        $this->assertTrue(session()->get('logged_in'));
    }



    public function testLoginFailure()
    {
        $result = $this->post('/login/auth', [
            'username' => 'wrong',
            'password' => 'wrong'
        ]);

        $result->assertRedirectTo('/login');
        $this->assertEmpty(session()->get('logged_in'));
    }



}
