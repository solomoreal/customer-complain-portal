<?php

namespace Database\Factories;
use App\Models\Complain;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplainFactory extends Factory
{
    protected $model = Complain::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(8),
            'message' => $this->faker->text(80),
            'reviewed' => rand(0, 1),
            'customer_id' => rand(1, 26),
            'branch_id' => rand(1, 3),
        ];
    }
}
