<?php

namespace Database\Factories;

use App\Models\TblUsuario;
use App\Models\TblRol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TblUsuarioFactory extends Factory
{
    protected $model = TblUsuario::class;
    public function definition()
    {
        return [
            'Nombre' => $this->faker->firstName(),
            'Apellidos' => $this->faker->lastName(),
            'Telefono' => $this->faker->phoneNumber(),
            'Email' => $this->faker->unique()->safeEmail(),
            'Contrasena' => Hash::make('uriel.12'),
            'Estado' => $this->faker->boolean(50),
            'RolID' => TblRol::inRandomOrder()->first()->RolID ?? TblRol::factory()->create()->RolID,
            'UltimoLogin' => $this->faker->dateTimeThisYear(),
            'remember_token' => Str::random(10),
        ];
    }
}
