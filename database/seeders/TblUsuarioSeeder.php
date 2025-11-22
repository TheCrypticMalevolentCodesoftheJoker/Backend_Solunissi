<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblUsuario;
use Illuminate\Support\Facades\Hash;

class TblUsuarioSeeder extends Seeder
{

    public function run(): void
    {
        TblUsuario::create([
            'Nombre'        => 'Uriel',
            'Apellidos'     => 'Turpo',
            'Telefono'      => '123456789',
            'Email'         => 'uriel@gmail.com',
            'Contrasena'    => Hash::make('Uriel.12'), 
            'Estado'        => true,
            'RolID'         => 1
        ]);
    }
}
