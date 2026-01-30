<?php

namespace Database\Seeders;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{

    public function run()
    {
        Group::create(['name' => '3WAG2']);
        Group::create(['name' => '3PAG2']);
    }

}
