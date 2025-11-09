<?php

namespace Database\Factories;

use App\Models\TblEmpleado;
use App\Models\TblCargo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblEmpleadoFactory extends Factory
{
    protected $model = TblEmpleado::class;

    public function definition()
    {
        $cargo = TblCargo::inRandomOrder()->first();

        return [
            'cargo_id'       => $cargo->id,
            'dni'            => $this->faker->unique()->numerify('########'),
            'nombres'        => $this->faker->firstName,
            'apellidos'      => $this->faker->lastName,
            'email'          => $this->faker->unique()->safeEmail,
            'telefono'       => $this->faker->optional()->phoneNumber,
            'direccion'      => $this->faker->optional()->address,
            'fecha_ingreso'  => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'estado'         => $this->faker->boolean(90),
        ];
    }
}
