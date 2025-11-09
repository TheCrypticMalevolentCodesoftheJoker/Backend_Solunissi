<?php

namespace Database\Factories;

use App\Models\TblProyecto;
use App\Models\TblContrato;
use App\Models\TblEmpleado;
use App\Models\TblAlmacen;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblProyectoFactory extends Factory
{
    protected $model = TblProyecto::class;

    public function definition()
    {
        return [
            'contrato_id' => TblContrato::inRandomOrder()->first()?->id ?? null,
            'nombre' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->optional()->date(),
            'almacen_id' => TblAlmacen::inRandomOrder()->first()?->id ?? null,
            'supervisor_id' => TblEmpleado::inRandomOrder()->first()?->id ?? null,
            'estado' => $this->faker->randomElement(['Pendiente']),
        ];
    }
}
