<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblRol;

class TblRolSeeder extends Seeder
{
    public function run(): void
    {
        TblRol::create([
            'NombreRol' => 'Administrador',
        ]);
    }
}
