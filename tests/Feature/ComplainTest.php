<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Complain;
use Tests\TestCase;

class ComplainTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function test_complaint_index_returns_ok(){
        $response = $this->get('/api/complaint');
        $response->assertOk();
     }
}
