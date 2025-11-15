<?php

namespace Database\Factories;

use App\Models\TblAlmacen;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblAlmacenFactory extends Factory
{
    protected $model = TblAlmacen::class;

    public function definition(): array
    {
        return [
            'nombre' => 'Almacén ' . $this->faker->unique()->city(),
            'ubicacion' => $this->faker->address(),
            'estado' => true,
        ];
    }
}
