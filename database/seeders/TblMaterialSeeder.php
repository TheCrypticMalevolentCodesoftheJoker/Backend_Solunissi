<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblMaterial;

class TblMaterialSeeder extends Seeder
{
    public function run(): void
    {
        TblMaterial::create([
            'codigo'        => 'MAT-00001',
            'nombre'        => 'Cable Drop Fibra Óptica 1 Hilo',
            'unidad_medida' => 'Metro'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00002',
            'nombre'        => 'Conector SC/APC',
            'unidad_medida' => 'Unidad'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00003',
            'nombre'        => 'Caja NAP 8 Puertos',
            'unidad_medida' => 'Unidad'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00004',
            'nombre'        => 'ONU GPON',
            'unidad_medida' => 'Unidad'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00005',
            'nombre'        => 'Bobina de Fibra Óptica 2 Hilos',
            'unidad_medida' => 'Metro'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00006',
            'nombre'        => 'Splitter Óptico 1x8',
            'unidad_medida' => 'Unidad'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00007',
            'nombre'        => 'Tubo Corrugado 1/2"',
            'unidad_medida' => 'Metro'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00008',
            'nombre'        => 'Cinta Autovulcanizable',
            'unidad_medida' => 'Rollo'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00009',
            'nombre'        => 'Conector SC/UPC',
            'unidad_medida' => 'Unidad'
        ]);

        TblMaterial::create([
            'codigo'        => 'MAT-00010',
            'nombre'        => 'Empalme por Fusión',
            'unidad_medida' => 'Unidad'
        ]);
    }
}
