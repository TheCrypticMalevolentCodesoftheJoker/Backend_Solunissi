<?php

namespace Tests\Feature;

use Tests\TestCase;

class ventaTest extends TestCase
{

    public function test_registrarContrato()
    {
        $data = [
            'cliente_id' => 2,
            'tipo_servicio' => 'Instalacion',
            'descripcion' => 'nuevo contrato',
            'fecha_firma'=> '2025-11-06',
            'fecha_vencimiento'=> '2025-11-06',
            'monto_total'=> '2000',
        ];

        $response = $this->postJson('/api/venta/contrato', $data);

        echo $response->getContent();
    }

    public function test_registrarPagoContrato()
    {
        $data = [
            'contrato_id' => 1,
            'monto' => '1000',
            'fecha_pago' => '2025-11-06',
            'medio_pago'=> 'Transferecnia',
        ];

        $response = $this->postJson('/api/venta/contrato-pago', $data);

        echo $response->getContent();
    }
    
}
// php artisan test --filter=VentaTest::test_registrarContrato
