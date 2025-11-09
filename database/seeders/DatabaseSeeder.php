<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            //Contabilidad
            TblCentroCostoSeeder::class,
            TblTipoTransaccionContableSeeder::class,
            TblCuentaContableSeeder::class,

            //RRHH
            TblCargoSeeder::class,


            //Proyecto
            TblProyectoSeeder::class,
        ]);

        $this->call([
            //RRHH
            TblEmpleadoSeeder::class,
        ]);

        $this->call([]);
    }
}
