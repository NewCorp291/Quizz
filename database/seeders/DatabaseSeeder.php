<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(10)->create();
         \App\Models\Quiz::factory(10)->create();
         \App\Models\Score::factory(20)->create();
         $this->call([
             QuestionSeeder::class,
             ChoiceSeeder::class,
         ]);

    }
}
