<?php

namespace Database\Seeders;

use App\Models\TblProyecto;
use Illuminate\Database\Seeder;

class TblProyectoSeeder extends Seeder
{
    public function run(): void
    {
        TblProyecto::factory()->count(5)->create();
    }
}
