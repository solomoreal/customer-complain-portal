<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;
class ManagerSeeder extends Seeder
{

    public function run()
    {
        Manager::factory()->times(3)->create();
    }
}
