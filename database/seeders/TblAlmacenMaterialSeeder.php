<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblAlmacenMaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_almacen_material')->insert([
            [
                'almacen_id' => 2,
                'proyecto_id' => 1,
                'material_id' => 1,
                'stock' => 120,
                'stock_minimo' => 0,
                'stock_maximo' => 0,
            ]
        ]);
    }
}
