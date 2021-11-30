<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class conv_discussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'conv_id' => 1,
            'user_id' => 1,
            'message' => Str::random(10)
        ];
    }
}
