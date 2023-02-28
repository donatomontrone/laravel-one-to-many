<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficulty = ['20%', '40%', '60%', '80%', '100%'];

        foreach ($difficulty as $difficultyEl) {
            $newDifficulty = new Difficulty();
            $newDifficulty->percentage = $difficultyEl;
            $newDifficulty->save();
        }
    }
}
