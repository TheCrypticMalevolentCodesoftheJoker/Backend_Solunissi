<?php

namespace Database\Seeders;

use App\Models\TblProyecto;
use Illuminate\Database\Seeder;

class TblProyectoSeeder extends Seeder
{
    public function run(): void
    {
        TblProyecto::create([
            'contrato_id'      => 1,
            'nombre'           => 'PROY-00001',
            'descripcion'      => 'Proyecto de instalación de red FTTH para el cliente. Incluye tendido de fibra, '
                . 'instalación de NAP, configuración de equipos y pruebas de señal.',
            'almacen_id'       => 2,
            'supervisor_id'    => 3,
            'fecha_inicio'     => '2025-11-01',
            'fecha_fin'        => '2025-12-30',
            'monto_asignado'   => 18500.00,
            'monto_ejecutado'  => 0,
            'estado'           => 'Inicializado',
        ]);

        TblProyecto::create([
            'contrato_id'      => 2,
            'nombre'           => 'PROY-00002',
            'descripcion'      => 'Proyecto anual de mantenimiento de red de fibra óptica. Incluye empalmes, '
                . 'revisión de OLT, ONUs y atención de averías programadas.',
            'almacen_id'       => null,
            'supervisor_id'    => null,
            'fecha_inicio'     => null,
            'fecha_fin'        => null,
            'monto_asignado'   => 0,
            'monto_ejecutado'  => 0,
            'estado'           => 'Programado',
        ]);
    }
}
