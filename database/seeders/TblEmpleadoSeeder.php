<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblEmpleado;

class TblEmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = [
            // 1 Administrador
            [
                'cargo_id'      => 1,
                'dni'           => '10000001',
                'nombres'       => 'Admin',
                'apellidos'     => 'Principal',
                'email'         => 'admin@example.com',
                'telefono'      => '987654001',
                'direccion'     => 'Av. Administrador 1',
                'fecha_ingreso' => '2023-01-01',
                'estado'        => true,
            ],
        ];

        // 5 Supervisores
        for ($i = 1; $i <= 5; $i++) {
            $empleados[] = [
                'cargo_id'      => 2,
                'dni'           => '2000000' . $i,
                'nombres'       => "Supervisor$i",
                'apellidos'     => "ApellidoS$i",
                'email'         => "supervisor$i@example.com",
                'telefono'      => '9876540' . (10 + $i),
                'direccion'     => "Calle Supervisor $i",
                'fecha_ingreso' => date('Y-m-d', strtotime("-$i year")),
                'estado'        => true,
            ];
        }

        // 5 Técnicos
        for ($i = 1; $i <= 5; $i++) {
            $empleados[] = [
                'cargo_id'      => 3,
                'dni'           => '3000000' . $i,
                'nombres'       => "Tecnico$i",
                'apellidos'     => "ApellidoT$i",
                'email'         => "tecnico$i@example.com",
                'telefono'      => '9876541' . (10 + $i),
                'direccion'     => "Calle Tecnico $i",
                'fecha_ingreso' => date('Y-m-d', strtotime("-$i year")),
                'estado'        => true,
            ];
        }
        for ($i = 1; $i <= 5; $i++) {
            $empleados[] = [
                'cargo_id'      => 4,
                'dni'           => '4000000' . $i,
                'nombres'       => "Vendedor$i",
                'apellidos'     => "ApellidoV$i",
                'email'         => "vendedor$i@example.com",
                'telefono'      => '9876542' . (10 + $i),
                'direccion'     => "Calle Vendedor $i",
                'fecha_ingreso' => date('Y-m-d', strtotime("-$i year")),
                'estado'        => true,
            ];
        }

        foreach ($empleados as $empleado) {
            TblEmpleado::create($empleado);
        }
    }
}
