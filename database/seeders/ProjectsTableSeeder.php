<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $table->id();
        // $table->string('slug', 255);
        // $table->string('name', 100)->unique();
        // $table->date('publication_date');
        // $table->text('preview')->nullable();
        // $table->tinyInteger('complexity');
        // $table->string('language_used', 100);
        // $table->text('github_url');
        // $table->timestamps();

        for ($i = 0; $i < 20; $i++) {
            $newProject = new Project();
            $newProject->name = $faker->sentence(3);
            $newProject->slug = Str::slug($newProject->name);
            $newProject->publication_date = $faker->date('Y-m-d', 'now');
            $newProject->preview = $faker->unique()->imageUrl();
            $newProject->complexity = $faker->numberBetween(1, 5);
            $newProject->type_id = Type::inRandomOrder()->first()->id;
            $newProject->github_url = $faker->url();
            $newProject->save();
        }
    }
}
