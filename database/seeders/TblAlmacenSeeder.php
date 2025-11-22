<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblAlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_almacen')->insert([
            [
                'nombre' => 'Almacén Central',
                'ubicacion' => 'Av. Principal 123, Ciudad',
                'estado' => true,
            ],
            [
                'nombre' => 'Almacén X',
                'ubicacion' => 'Av. Principal 123, Ciudad',
                'estado' => true,
            ],
        ]);
    }
}
