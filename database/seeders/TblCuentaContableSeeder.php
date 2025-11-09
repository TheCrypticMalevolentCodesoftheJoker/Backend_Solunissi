<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TblCuentaContableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $cuentas = [
            ['id' => 1, 'codigo' => '101', 'nombre' => 'Caja y Bancos', 'tipo' => 'Activo', 'descripcion' => 'Dinero disponible en caja y cuentas bancarias de la empresa.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'codigo' => '102', 'nombre' => 'Cuentas por Cobrar', 'tipo' => 'Activo', 'descripcion' => 'Créditos a clientes por servicios de telecomunicaciones pendientes de pago.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'codigo' => '103', 'nombre' => 'Equipos y Herramientas', 'tipo' => 'Activo', 'descripcion' => 'Equipos de instalación, herramientas técnicas y dispositivos de red propiedad de la empresa.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'codigo' => '201', 'nombre' => 'Cuentas por Pagar', 'tipo' => 'Pasivo', 'descripcion' => 'Obligaciones con proveedores y acreedores por compras o servicios recibidos.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'codigo' => '202', 'nombre' => 'Préstamos Bancarios', 'tipo' => 'Pasivo', 'descripcion' => 'Deudas con entidades financieras utilizadas para financiar proyectos de telecomunicaciones.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'codigo' => '301', 'nombre' => 'Capital Social', 'tipo' => 'Patrimonio', 'descripcion' => 'Aportes de los socios o accionistas para el funcionamiento de la empresa.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'codigo' => '401', 'nombre' => 'Ingresos por Servicios de Internet', 'tipo' => 'Ingreso', 'descripcion' => 'Ganancias obtenidas por la prestación de servicios de internet y conectividad.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'codigo' => '402', 'nombre' => 'Ingresos por Instalaciones', 'tipo' => 'Ingreso', 'descripcion' => 'Cobros por instalación de equipos, antenas o routers en proyectos o clientes nuevos.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'codigo' => '501', 'nombre' => 'Gastos de Materiales y Suministros', 'tipo' => 'Egreso', 'descripcion' => 'Costos de cables, antenas, routers y demás materiales necesarios para las instalaciones.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'codigo' => '502', 'nombre' => 'Gastos de Personal Técnico', 'tipo' => 'Egreso', 'descripcion' => 'Sueldos, viáticos y beneficios del personal técnico encargado de proyectos e instalaciones.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'codigo' => '503', 'nombre' => 'Gastos Administrativos', 'tipo' => 'Egreso', 'descripcion' => 'Costos de oficina, suministros administrativos y personal de gestión.', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tbl_cuenta_contable')->insert($cuentas);
    }
}
