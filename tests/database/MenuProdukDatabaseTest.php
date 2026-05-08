<?php

namespace Tests\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MenuProduk;

class MenuProdukDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;
    protected $refresh = true;
    protected $seed    = 'App\Database\Seeds\MenuProdukTableSeeder';
    protected $namespace = 'App';

    public function testInsertMenuProduk()
    {
        $model = new MenuProduk();
        
        $data = [
            'nama_produk' => 'Espresso Test',
            'harga'       => 20000,
            'deskripsi'   => 'Test deskripsi',
            'kategori'    => 'Kopi'
        ];

        $model->insert($data);
        
        $this->seeInDatabase('menu_produk', ['nama_produk' => 'Espresso Test']);
    }

    public function testSeederWorks()
    {
        $this->seeInDatabase('menu_produk', ['nama_produk' => 'Kopi Kenangan Mantan']);
    }
}
