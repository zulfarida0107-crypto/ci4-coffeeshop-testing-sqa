<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\User;

class UserModelTest extends CIUnitTestCase
{
    public function testModelHasCorrectTable()
    {
        $model = new User();
        $this->assertEquals('user', $model->table);
    }

    public function testModelReturnType()
    {
        $model = new User();
        $this->assertEquals('array', $model->returnType);
    }
}
