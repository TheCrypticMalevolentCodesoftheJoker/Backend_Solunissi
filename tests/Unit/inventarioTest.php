<?php

namespace Tests\Feature;

use Tests\TestCase;

class inventarioTest extends TestCase
{
    public function test_registrarAlmacen()
    {
        $almacen = [
            'nombre'        => 'almacen',
            'tipo_almacen'  => 'Central',
            'ubicacion'     => 'Lima',
            'stock_minimo'  => '200',
            'stock_maximo'  => '300'
        ];
        $response = $this->postJson('/api/inventario/almacen', $almacen);
        echo $response->getContent();
    }

    public function test_registrarMaterial()
    {
        $material = [
            'nombre'      => 'cinta',
            'unidad_medida'   => 'caja'
        ];

        $response = $this->postJson('/api/inventario/material', $material);
        echo $response->getContent();
    }
    
    public function test_registrarEntrada()
    {
        $entrada = [
            'almacen_origen_id'  => null,
            'almacen_destino_id' => 1,
            'proyecto_id'        => null,
            'tipo'               => 'Entrada',
            'referencia'         => 'OC-00001',
            'detalle' => [
                [
                    'material_id' => 1,
                    'cantidad' => 30
                ]
            ]
        ];

        $response = $this->postJson('/api/inventario', $entrada);
        echo $response->getContent();
    }
}
// php artisan test --filter=inventarioTest::test_registrarAlmacen
