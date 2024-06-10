<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'personal_id'           => rand(1000000000, 2999999999),
            'mobile'                  => rand(500000000, 599999999),
            'name'                    => $this->faker->name(),
            'confirmation_code'     => rand(1000, 9999),
        ];
    }
}
