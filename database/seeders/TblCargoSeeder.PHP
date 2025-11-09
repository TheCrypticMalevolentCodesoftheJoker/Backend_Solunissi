<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TblCargoSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $now = Carbon::now();

        $cargos = [
            // Autenticación y Administración
            ['nombre' => 'Administrador', 'salario_base' => 7000.00, 'created_at' => $now, 'updated_at' => $now],

            // Contabilidad
            ['nombre' => 'Contador', 'salario_base' => 4500.00, 'created_at' => $now, 'updated_at' => $now],

            // RRHH
            ['nombre' => 'Jefe de RRHH', 'salario_base' => 5000.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Supervisor', 'salario_base' => 3500.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Empleado', 'salario_base' => 2000.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Técnico', 'salario_base' => 1200.00, 'created_at' => $now, 'updated_at' => $now],

            // Compras
            ['nombre' => 'Gerente de Compras', 'salario_base' => 6000.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Jefe de Compras', 'salario_base' => 4500.00, 'created_at' => $now, 'updated_at' => $now],

            // Inventario / Almacén
            ['nombre' => 'Jefe de Almacén', 'salario_base' => 4000.00, 'created_at' => $now, 'updated_at' => $now],

            // Producción
            ['nombre' => 'Gerente de Producción', 'salario_base' => 6500.00, 'created_at' => $now, 'updated_at' => $now],

            // Logística
            ['nombre' => 'Jefe de Logística', 'salario_base' => 4500.00, 'created_at' => $now, 'updated_at' => $now],

            // Ventas / Comercial
            ['nombre' => 'Gerente Comercial', 'salario_base' => 6000.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Jefe de Ventas', 'salario_base' => 4500.00, 'created_at' => $now, 'updated_at' => $now],
            ['nombre' => 'Ejecutivo Comercial', 'salario_base' => 3000.00, 'created_at' => $now, 'updated_at' => $now],

            // CRM
            ['nombre' => 'Supervisor de CRM', 'salario_base' => 3500.00, 'created_at' => $now, 'updated_at' => $now],

            // Proyectos
            ['nombre' => 'Gerente de Proyectos', 'salario_base' => 7000.00, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tbl_cargo')->insert($cargos);
    }
}
