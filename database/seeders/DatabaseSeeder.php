<?php

namespace Database\Seeders;

use App\Models\conv_discussion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        conv_discussion::factory()->count(10000)->create();
    }
}
