<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Front-End', 'color' => '#1C4B29'],
            ['name' => 'Back-End', 'color' => '#D95757'],
            ['name' => 'Full Stack', 'color' => '#2473E7']
        ];

        foreach ($types as $type) {
            $newType = new Type();
            $newType->name = $type['name'];
            $newType->color = $type['color'];
            $newType->save();
        }
    }
}
