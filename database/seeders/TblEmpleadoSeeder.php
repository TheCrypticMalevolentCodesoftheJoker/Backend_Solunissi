<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblEmpleado;

class TblEmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        TblEmpleado::factory()->count(5)->create();
    }
}
