<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ErabiltzaileakTableSeeder extends Seeder
{
    public function run()
    {
        $erabiltzaileak = [
            [
                'erabiltzaile_izena' => 'admin',
                'posta_elek' => 'admin@ileapaindegi.com',
                'rola' => 'A',
                'password' => Hash::make('admin123'),
            ],
            [
                'erabiltzaile_izena' => 'ileapaindegia1',
                'posta_elek' => 'ileapaindegia1@ileapaindegi.com',
                'rola' => 'I',
                'password' => Hash::make('peluquero123'),
            ],
            [
                'erabiltzaile_izena' => 'estilista1',
                'posta_elek' => 'estilista1@ileapaindegi.com',
                'rola' => 'E',
                'password' => Hash::make('estilista123'),
            ],
            [
                'erabiltzaile_izena' => 'harrera',
                'posta_elek' => 'harrera@ileapaindegi.com',
                'rola' => 'H',
                'password' => Hash::make('recepcion123'),
            ],
        ];

        foreach ($erabiltzaileak as $erabiltzailea) {
            DB::table('erabiltzaileak')->updateOrInsert(
                ['erabiltzaile_izena' => $erabiltzailea['erabiltzaile_izena']],
                array_merge($erabiltzailea, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}