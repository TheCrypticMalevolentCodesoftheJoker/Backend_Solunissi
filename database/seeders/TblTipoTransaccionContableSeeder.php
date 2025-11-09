<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblTipoTransaccionContableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            [
                'nombre' => 'Ingreso',
                'descripcion' => 'Transacciones que representan entradas de dinero a la empresa',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nombre' => 'Egreso',
                'descripcion' => 'Transacciones que representan salidas de dinero de la empresa',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nombre' => 'Gasto',
                'descripcion' => 'Transacciones relacionadas a gastos operativos de proyectos o instalaciones',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nombre' => 'Costo',
                'descripcion' => 'Transacciones que representan costos asociados a proyectos o instalaciones',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('tbl_tipo_transaccion_contable')->insert($data);
    }
}
