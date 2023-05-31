<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Matter;
use App\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach (['Matemática Discreta', 'Física Geral', 'AOC'] as $m) {
            Matter::factory(1)->hasTopics(2)->create(['title' => $m]);
        }
        Topic::factory(4)->hasAnswers(4)->create();
    }
}
