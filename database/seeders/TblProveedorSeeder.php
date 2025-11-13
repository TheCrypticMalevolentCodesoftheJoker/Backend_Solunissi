<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblProveedor;

class TblProveedorSeeder extends Seeder
{
    public function run(): void
    {
        TblProveedor::factory()->count(10)->create();
    }
}
