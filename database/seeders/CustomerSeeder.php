<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
class CustomerSeeder extends Seeder
{
    
    public function run()
    {
        Customer::factory()->times(26)->create();
    }
}
