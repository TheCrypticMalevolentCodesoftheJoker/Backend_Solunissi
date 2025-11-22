<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Autentificacion
            TblRolSeeder::class,
            TblUsuarioSeeder::class,
            // CRM
            TblLeadSeeder::class,
            TblClienteSeeder::class,
            // Venta
            TblContratoSeeder::class,
            // RRHH
            TblCargoSeeder::class,
            TblEmpleadoSeeder::class,
            // Inventario
            TblAlmacenSeeder::class,
            TblMaterialSeeder::class,
            // Compras
            TblProveedorSeeder::class,
            // Contabilidad
            TblCentroCostoSeeder::class,
            TblTipoTransaccionContableSeeder::class,
            TblCuentaContableSeeder::class,

        ]);

        $this->call([
            // Proyecto
            TblProyectoSeeder::class,
            // Inventario
            TblAlmacenMaterialSeeder::class,


        ]);

        $this->call([]);
    }
}
