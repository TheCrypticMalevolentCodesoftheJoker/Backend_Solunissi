<?php

namespace Tests\Feature;

use Tests\TestCase;

class comprasTest extends TestCase
{
    public function test_registrar_proveedor()
    {
        $proveedor = [
            'razon_social'      => 'Comercial Soluciones SAC',
            'nombre_comercial'  => 'SolucionesTech',
            'ruc'               => '20601234567',
            'direccion'         => 'Av. Principal 123 - Lima',
            'telefono'          => '987654321',
            'correo'            => 'contacto@solucionestech.com',
            'pagina_web'        => 'https://solucionestech.com',
            'contacto_nombre'   => 'Juan Pérez',
            'contacto_telefono' => '999888777',
            'contacto_correo'   => 'jperez@solucionestech.com'
        ];

        $response = $this->postJson('/api/compra/proveedor', $proveedor);
        echo $response->getContent();
    }

    public function test_registrarCotizacion()
    {
        $data = [
            'solicitud_compra_id' => 1,
            'proveedor_id' => 1,
            'fecha_cotizacion' => '2025-11-12',
            'tiempo_entrega_dias' => 7,
            'costo_envio' => 100,
            'descuento' => 0,
            'detalles' => [
                [
                    'material_id' => 1,
                    'cantidad' => 30,
                    'precio_unitario' => 10
                ]
            ]
        ];

        $response = $this->postJson('/api/compra/cotizacion', $data);

        echo $response->getContent();
    }

    public function test_registrarOrdenCompra()
    {
        $response = $this->postJson('/api/compra/orden-compra/1');
        echo $response->getContent();
    }
}
// php artisan test --filter=comprasTest::test_registrarOrdenCompra
