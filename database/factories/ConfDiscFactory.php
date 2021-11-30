<?php

namespace Database\Factories;

use App\Models\conv_discussion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConfDiscFactory extends Factory
{
    protected $model = conv_discussion::class;
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
