<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TruncateInmueblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('inmuebles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('imagenes_inmuebles')->truncate();
    }
}
