<?php

namespace Database\Factories;

use App\Models\TblMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblMaterialFactory extends Factory
{
    protected $model = TblMaterial::class;

    public function definition()
    {
        return [
            'codigo'        => strtoupper($this->faker->bothify('MAT-###??')),
            'nombre'        => ucfirst($this->faker->words(3, true)),
            'unidad_medida' => $this->faker->randomElement(['unidad', 'metro', 'rollo', 'kg', 'litro', 'paquete']),
        ];
    }
}
