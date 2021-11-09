<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{

    public function run()
    {
        Branch::factory(3)->create();
    }

    //composer create-project laravel/laravel complain-management-portal

}
