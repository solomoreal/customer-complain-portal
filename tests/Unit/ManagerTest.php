<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Manager;

class ManagerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_manager_index_api_function(){
        $response = $this->get('/api/manager');
        $this->assetStatus(200);
    }
}
