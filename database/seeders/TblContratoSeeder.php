<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblContrato;

class TblContratoSeeder extends Seeder
{
    public function run(): void
    {
        TblContrato::create([
            'codigo'            => 'CT-00001',
            'cliente_id'        => 1,
            'tipo_servicio'     => 'Instalación de Fibra Óptica',
            'descripcion'       => 'Servicio de instalación de red de fibra óptica FTTH para el cliente, '
                                    . 'incluye tendido de cable, configuración de equipos y pruebas de conectividad.',
            'fecha_firma'       => '2024-01-10',
            'fecha_vencimiento' => '2024-06-30',
            'monto_total'       => 18500.00,
            'estado'            => 'Activo',
        ]);

        TblContrato::create([
            'codigo'            => 'CT-00002',
            'cliente_id'        => 2,
            'tipo_servicio'     => 'Mantenimiento y Soporte de Red',
            'descripcion'       => 'Contrato anual de mantenimiento preventivo y correctivo de la red de fibra óptica '
                                    . 'incluyendo revisión de OLT, ONUs, empalmes y atención de averías.',
            'fecha_firma'       => '2024-02-05',
            'fecha_vencimiento' => '2025-02-05',
            'monto_total'       => 9600.00,
            'estado'            => 'Activo',
        ]);
    }
}
