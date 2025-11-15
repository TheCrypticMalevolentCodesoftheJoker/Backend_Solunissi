<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // CRM
            TblLeadSeeder::class,
            TblClienteSeeder::class,
            // Venta
            TblContratoSeeder::class,
            // Proyecto
            TblProyectoSeeder::class,

            // Inventario
            TblMaterialSeeder::class,


            // Contabilidad
            // TblCentroCostoSeeder::class,
            // TblTipoTransaccionContableSeeder::class,
            // TblCuentaContableSeeder::class,

            // RRHH
            // TblCargoSeeder::class,

            // Compras
            // TblProveedorSeeder::class,


            // Invetario
            // TblAlmacenSeeder::class,
        ]);

        $this->call([
            // RRHH
            // TblEmpleadoSeeder::class,

            // Logistica
            // TblAlmacenMaterialSeeder::class,

        ]);

        $this->call([]);
    }
}
