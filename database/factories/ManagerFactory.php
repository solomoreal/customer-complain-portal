<?php

namespace Database\Factories;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagerFactory extends Factory
{
    protected $model = Manager::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber,
            'branch_id' => random_int(1, 3),
        ];
    }
}
