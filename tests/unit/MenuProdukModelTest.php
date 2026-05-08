<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\MenuProduk;

class MenuProdukModelTest extends CIUnitTestCase
{
    /**
     * Skenario: Memastikan bahwa model MenuProduk menggunakan nama tabel yang benar.
     */
    public function testModelHasCorrectTable()
    {
        $model = new MenuProduk();
        
        // Asumsi nama tabel di model adalah 'menu_produk'
        // Jika nama tabel berbeda, ubah 'menu_produk' dengan nama yang sesuai.
        $this->assertEquals('menu_produk', $model->table);
    }

    /**
     * Skenario: Memastikan tipe kembalian data adalah object atau array sesuai konfigurasi CI4.
     */
    public function testModelReturnType()
    {
        $model = new MenuProduk();
        $this->assertEquals('array', $model->returnType);
    }
}
