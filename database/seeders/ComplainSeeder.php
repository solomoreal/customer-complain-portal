<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complain;
class ComplainSeeder extends Seeder
{
    
    public function run()
    {
        Complain::factory()->times(100)->create();
    }
}
