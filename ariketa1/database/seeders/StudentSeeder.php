<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $groups = Group::all();

        $ikasleak = [
            ['id' => 1, 'name' => 'Ane', 'age' => 20],
            ['id' => 2, 'name' => 'Unai', 'age' => 22],
            ['id' => 3, 'name' => 'Maite', 'age' => 19],
            ['id' => 4, 'name' => 'Gorka', 'age' => 21],
            ['id' => 5, 'name' => 'Leire', 'age' => 23],
            ['id' => 6, 'name' => 'Iker', 'age' => 20],
            ['id' => 7, 'name' => 'Amaia', 'age' => 21],
            ['id' => 8, 'name' => 'Eneko', 'age' => 22],
            ['id' => 9, 'name' => 'Ainhoa', 'age' => 19],
            ['id' => 10, 'name' => 'Jon', 'age' => 23],
        ];

        foreach ($ikasleak as $ikaslea) {
            Student::create([
                'name' => $ikaslea['name'],
                'surnames' => '', 
                'age' => $ikaslea['age'],
                'group_id' => $groups->random()->id,
            ]);
        }
    }
}