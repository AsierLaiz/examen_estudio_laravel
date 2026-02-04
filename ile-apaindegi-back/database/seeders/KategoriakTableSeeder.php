<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriakTableSeeder extends Seeder
{
    public function run()
    {
        $kategoriak = [
            ['izena' => 'Ile produktuak', 'created_at' => now(), 'updated_at' => now()],
            ['izena' => 'Hatzak produktuak', 'created_at' => now(), 'updated_at' => now()],
            ['izena' => 'Tratamenduak', 'created_at' => now(), 'updated_at' => now()],
            ['izena' => 'Finkatzaileak', 'created_at' => now(), 'updated_at' => now()],
            ['izena' => 'Kondizionadoreak', 'created_at' => now(), 'updated_at' => now()],
            ['izena' => 'Koloreztatzea', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kategoriak')->insert($kategoriak);
    }
}
