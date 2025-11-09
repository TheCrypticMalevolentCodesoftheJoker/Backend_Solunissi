<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCentroCostoSeeder extends Seeder
{


    public function run(): void
    {
        $now = Carbon::now();

        $centros = [
            ['id' => 1, 'nombre' => 'Materiales y suministros', 'descripcion' => 'Gastos en materiales, cables, routers, antenas y suministros necesarios para las instalaciones y mantenimiento de la red.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'nombre' => 'Mano de obra', 'descripcion' => 'Costos de personal técnico y administrativo directamente involucrado en proyectos y operaciones.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'nombre' => 'Infraestructura', 'descripcion' => 'Inversión en torres, antenas, servidores, racks y equipos de red.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'nombre' => 'Mantenimiento y soporte', 'descripcion' => 'Gastos asociados al mantenimiento de la red, reparaciones y soporte técnico.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'nombre' => 'Administración', 'descripcion' => 'Gastos generales administrativos de la empresa, como oficinas, suministros y personal de gestión.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'nombre' => 'Proyectos especiales', 'descripcion' => 'Costos asociados a proyectos específicos de expansión de red o innovación tecnológica.', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tbl_centro_costo')->insert($centros);
    }
}
