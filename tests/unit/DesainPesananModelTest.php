<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\DesainPesanan;

class DesainPesananModelTest extends CIUnitTestCase
{
    public function testModelHasCorrectTable()
    {
        $model = new DesainPesanan();
        $this->assertEquals('desain_pesanan', $model->table);
    }

    public function testModelReturnType()
    {
        $model = new DesainPesanan();
        $this->assertEquals('array', $model->returnType);
    }
}
