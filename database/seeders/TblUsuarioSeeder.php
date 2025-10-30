<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblUsuario;
use Illuminate\Support\Facades\Hash;

class TblUsuarioSeeder extends Seeder
{

    public function run(): void
    {
        TblUsuario::factory()->count(5)->create();  
    }
}
