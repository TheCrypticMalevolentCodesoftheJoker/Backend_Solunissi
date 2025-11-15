<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            ['nombre' => 'Administrador', 'salario_base' => 7000.00],
            ['nombre' => 'Supervisor', 'salario_base' => 4500.00],
            ['nombre' => 'Tecnico', 'salario_base' => 4500.00],
            ['nombre' => 'Vendedor', 'salario_base' => 4500.00],
        ];

        DB::table('tbl_cargo')->insert($cargos);
    }
}
