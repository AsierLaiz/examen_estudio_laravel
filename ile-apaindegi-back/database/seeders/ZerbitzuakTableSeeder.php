<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZerbitzuakTableSeeder extends Seeder
{
    public function run()
    {
        $zerbitzuak = [
            [
                'izena' => 'Ilea apaindua',
                'prezioa' => 5.00,
                'etxeko_prezioa' => 8.00,
                'iraunaldia' => 30, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Moztu',
                'prezioa' => 4.00,
                'etxeko_prezioa' => 6.50,
                'iraunaldia' => 45,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Kolorea - Laburra',
                'prezioa' => 12.00,
                'etxeko_prezioa' => 19.20,
                'iraunaldia' => 60,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Kolorea - Ertaina',
                'prezioa' => 14.00,
                'etxeko_prezioa' => 22.40,
                'iraunaldia' => 75,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Kolorea - Luzea',
                'prezioa' => 16.00,
                'etxeko_prezioa' => 25.60,
                'iraunaldia' => 90,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Kolorea - Oso luzea',
                'prezioa' => 18.00,
                'etxeko_prezioa' => 28.80,
                'iraunaldia' => 105,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Mechak partzialak - Laburra',
                'prezioa' => 7.00,
                'etxeko_prezioa' => 11.20,
                'iraunaldia' => 90,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Mechak - Luzea',
                'prezioa' => 19.00,
                'etxeko_prezioa' => 30.40,
                'iraunaldia' => 120,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Mechak + Kolorea - Ertaina',
                'prezioa' => 27.00,
                'etxeko_prezioa' => 43.20,
                'iraunaldia' => 150,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Dekorazioa (kazo bakoitzeko)',
                'prezioa' => 4.00,
                'etxeko_prezioa' => 4.00,
                'iraunaldia' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Permanentea',
                'prezioa' => 15.00,
                'etxeko_prezioa' => 24.00,
                'iraunaldia' => 120,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Permanente lisoa',
                'prezioa' => 25.00,
                'etxeko_prezioa' => 40.00,
                'iraunaldia' => 180,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Maskara kolorea - Laburra',
                'prezioa' => 5.00,
                'etxeko_prezioa' => 8.00,
                'iraunaldia' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Manikura',
                'prezioa' => 4.00,
                'etxeko_prezioa' => 6.50,
                'iraunaldia' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Manikura semi-permanentea',
                'prezioa' => 9.00,
                'etxeko_prezioa' => 14.40,
                'iraunaldia' => 60,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Pedikura',
                'prezioa' => 5.00,
                'etxeko_prezioa' => 8.00,
                'iraunaldia' => 45,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'izena' => 'Ile hidratatzeko tratamendua',
                'prezioa' => 8.00,
                'etxeko_prezioa' => 12.80,
                'iraunaldia' => 45,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Salerm keratina tratamendua',
                'prezioa' => 35.00,
                'etxeko_prezioa' => 56.00,
                'iraunaldia' => 150,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'izena' => 'Thalassotherapy tratamendua',
                'prezioa' => 12.00,
                'etxeko_prezioa' => 19.20,
                'iraunaldia' => 60,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('zerbitzuak')->insert($zerbitzuak);
    }
}
