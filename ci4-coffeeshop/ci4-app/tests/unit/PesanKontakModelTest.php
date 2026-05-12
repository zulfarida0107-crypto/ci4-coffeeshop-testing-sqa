<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\PesanKontak;

class PesanKontakModelTest extends CIUnitTestCase
{
    public function testModelHasCorrectTable()
    {
        $model = new PesanKontak();
        $this->assertEquals('pesan_kontak', $model->table);
    }

    public function testModelReturnType()
    {
        $model = new PesanKontak();
        $this->assertEquals('array', $model->returnType);
    }
}
