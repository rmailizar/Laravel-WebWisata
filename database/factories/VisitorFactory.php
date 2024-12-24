<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    protected $model = Visitor::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(18, 65),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'origin' => $this->faker->city,
            'visit_date' => $this->faker->dateTimeThisYear,
            'notes' => $this->faker->sentence,
        ];
    }
}
