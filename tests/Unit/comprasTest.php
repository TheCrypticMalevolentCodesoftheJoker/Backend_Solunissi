<?php

namespace Tests\Feature;

use Tests\TestCase;

class comprasTest extends TestCase
{
    public function test_registrarSolicitudCompras()
    {
        $data = [
            'proyecto_id' => 1,
            'supervisor_id' => 1,
            'fecha_solicitud' => '2025-11-06',
            'detalles' => [
                [
                    'material_id' => 2,
                    'unidad_medida' => 'rollo',
                    'cantidad' => 10
                ],
                [
                    'material_id' => 5,
                    'unidad_medida' => 'metro',
                    'cantidad' => 25
                ]
            ]
        ];

        $response = $this->postJson('/api/compra/solicitud-compras', $data);

        echo $response->getContent();
    }

    public function test_registrarCotizacion()
    {
        $data = [
            'solicitud_compra_id' => 1,
            'proveedor_id' => 1,
            'proyecto_id' => 1,
            'fecha_cotizacion' => '2025-11-12',
            'tiempo_entrega_dias' => 7,
            'costo_envio' => 100,
            'descuento' => 0,
            'detalles' => [
                [
                    'material_id' => 2,
                    'cantidad' => 10,
                    'precio_unitario' => 10
                ],
                [
                    'material_id' => 5,
                    'cantidad' => 20,
                    'precio_unitario' => 10
                ]
            ]
        ];

        $response = $this->postJson('/api/compra/cotizaciones', $data);

        echo $response->getContent();
    }

    public function test_registrarOrdenCompra()
    {
        $data = [
            'proyecto_id' => 1,
            'cotizacion_id' => 1
        ];

        $response = $this->postJson('/api/compra/ordenes-compra', $data);

        echo $response->getContent();
    }
    public function test_aprobarOrdenCompra()
    {
        $response = $this->postJson('/api/compra/ordenes-compra/1/aprobar');

        echo $response->getContent();
    }
}
// php artisan test --filter=comprasTest::test_aprobarOrdenCompra
