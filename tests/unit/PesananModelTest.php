<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\Pesanan;

class PesananModelTest extends CIUnitTestCase
{
    public function testModelHasCorrectTable()
    {
        $model = new Pesanan();
        $this->assertEquals('pesanan', $model->table);
    }

    public function testModelReturnType()
    {
        $model = new Pesanan();
        $this->assertEquals('array', $model->returnType);
    }
}
