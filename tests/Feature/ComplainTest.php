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
     public function test_only_logged_in_user_can_see_complain_view(){
        $response = $this->get('/complaints');
        $response->assertStatus(302);
        $response->assertSee('login');
     }
}
