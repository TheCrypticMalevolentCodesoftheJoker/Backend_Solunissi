<?php

namespace Tests\Feature;

use Tests\TestCase;

class inventarioTest extends TestCase
{
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
// php artisan test --filter=inventarioTest::test_registrarEntrada
