<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Director;
use App\Models\Movie;


class DirectorSeeder extends Seeder
{
    public function run(): void
    {
        $directors=[
            ['nombre' => 'Steven Spielberg', 'pais' => 'USA'],
            ['nombre' => 'Martin Scorsese', 'pais' => 'USA'],
            ['nombre' => 'Quentin Tarantino', 'pais' => 'USA'],
        ];
        foreach ($directors as $director) {
            $director= Director::create($director);
            Movie::create([
                'titulo' => 'Movie of ' . $director->nombre,
                'ano_estreno' => 2000 + rand(0, 23),
                'director_id' => $director->id,
            ]);
            Movie::create([
                'titulo' => 'Another Movie of ' . $director->nombre,
                'ano_estreno' => 2000 + rand(0, 23),
                'director_id' => $director->id,
            ]);
        }

    }
}
