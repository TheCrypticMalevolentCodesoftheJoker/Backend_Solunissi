<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblMaterial;

class TblMaterialSeeder extends Seeder
{
    public function run(): void
    {
        TblMaterial::factory()->count(10)->create();
    }
}
