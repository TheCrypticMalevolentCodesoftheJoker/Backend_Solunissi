<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------------------------------------------
        // Tablas principales: Tablas independientes que no dependen de otras
        // -------------------------------------------------------------------
        $this->call([
            TblRolSeeder::class,
        ]);

        // -------------------------------------------------------------------
        // Tablas secundarias: Dependen de las tablas principales
        // -------------------------------------------------------------------
        $this->call([
            TblUsuarioSeeder::class,
        ]);

        // -------------------------------------------------------------------
        // Tablas terciarias o adicionales: Dependen de tablas secundarias o múltiples tablas
        // -------------------------------------------------------------------
        $this->call([]);
    }
}
