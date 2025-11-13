<?php

namespace Database\Factories;

use App\Models\TblProveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblProveedorFactory extends Factory
{
    protected $model = TblProveedor::class;

    public function definition()
    {
        return [
            'razon_social' => $this->faker->company,
            'ruc'          => $this->faker->unique()->numerify('###########'),
            'direccion'    => $this->faker->optional(0.7)->address,
            'telefono'     => $this->faker->optional(0.3)->phoneNumber,
            'correo'       => $this->faker->unique()->companyEmail,
            'estado'       => $this->faker->boolean(90),

        ];
    }
}
