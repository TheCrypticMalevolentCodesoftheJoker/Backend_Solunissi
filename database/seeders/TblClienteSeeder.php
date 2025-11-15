<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblCliente;

class TblClienteSeeder extends Seeder
{
    public function run(): void
    {
        TblCliente::create([
            'lead_id'        => 1,
            'ruc'            => '20604578123',
            'razon_social'   => 'Tech Innovation SAC',
            'tipo_cliente'   => 'Empresa',
            'direccion'      => 'Av. Los Olivos 345, San Isidro',
            'pais'           => 'Perú',
            'departamento'   => 'Lima',
            'provincia'      => 'Lima',
            'distrito'       => 'San Isidro',
            'web'            => 'https://www.techinnovation.com',
            'sector'         => 'Tecnología',
            'referencia'     => 'Frente a Torre Azul',
            'cargo_contacto' => 'Gerente de IT',
            'area_contacto'  => 'Tecnología',
            'linkedin'       => 'https://linkedin.com/in/carlos-gomez-ti',
            'facebook'       => 'https://facebook.com/techinnovation',
            'twitter'        => 'https://twitter.com/techinnovation',
            'instagram'      => 'https://instagram.com/techinnovation',
            'estado'         => 'Activo',
        ]);

        TblCliente::create([
            'lead_id'        => 2,
            'ruc'            => '20457896312',
            'razon_social'   => 'Distribuciones Andinas SAC',
            'tipo_cliente'   => 'Empresa',
            'direccion'      => 'Jr. Las Flores 789, Cercado',
            'pais'           => 'Perú',
            'departamento'   => 'Arequipa',
            'provincia'      => 'Arequipa',
            'distrito'       => 'Cercado',
            'web'            => 'http://www.distribucionesandinas.com',
            'sector'         => 'Comercial',
            'referencia'     => 'A una cuadra del Mall Plaza Arequipa',
            'cargo_contacto' => 'Jefe de Compras',
            'area_contacto'  => 'Abastecimiento',
            'linkedin'       => 'https://linkedin.com/in/maria-torres-compras',
            'facebook'       => 'https://facebook.com/distribucionesandinas',
            'twitter'        => 'https://twitter.com/andinas_sac',
            'instagram'      => 'https://instagram.com/distribucionesandinas',
            'estado'         => 'Activo',
        ]);
    }
}
