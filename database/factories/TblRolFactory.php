<?php

namespace Database\Factories;

use App\Models\TblRol;
use Illuminate\Database\Eloquent\Factories\Factory;

class TblRolFactory extends Factory
{
    protected $model = TblRol::class;
    
    public function definition()
    {
        return [
            'NombreRol' => $this->faker->unique()->jobTitle(), 
        ];
    }
}
