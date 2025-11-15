<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblLeadSeeder extends Seeder
{
    public function run(): void
    {
        $leads = [
            [
                'nombre'   => 'Carlos',
                'apellido' => 'Gómez',
                'empresa'  => 'Tech Innovation SAC',
                'correo'   => 'carlos.gomez@techinnovation.com',
                'telefono' => '987654321',
                'fuente'   => 'Página Web',
                'estado'   => 'Covertido'
            ],
            [
                'nombre'   => 'María',
                'apellido' => 'Torres',
                'empresa'  => 'Distribuciones Andinas',
                'correo'   => 'maria.torres@andinas.pe',
                'telefono' => '945123658',
                'fuente'   => 'Facebook Ads',
                'estado'   => 'Covertido'
            ],
            [
                'nombre'   => 'Jorge',
                'apellido' => 'Pérez',
                'empresa'  => 'Soluciones Industriales SAC',
                'correo'   => 'jperez@solind.pe',
                'telefono' => '912458736',
                'fuente'   => 'Referido',
                'estado'   => 'En negociación'
            ],
            [
                'nombre'   => 'Lucía',
                'apellido' => 'Ramírez',
                'empresa'  => 'nuevo',
                'correo'   => 'lucia.ramirez@gmail.com',
                'telefono' => '953741258',
                'fuente'   => 'Instagram',
                'estado'   => 'Nuevo'
            ],
            [
                'nombre'   => 'Pedro',
                'apellido' => 'Vargas',
                'empresa'  => 'Servicios Generales Vargas',
                'correo'   => 'vargas.servicios@gmail.com',
                'telefono' => '999222555',
                'fuente'   => 'Llamada directa',
                'estado'   => 'Calificado'
            ]
        ];

        DB::table('tbl_lead')->insert($leads);
    }
}
