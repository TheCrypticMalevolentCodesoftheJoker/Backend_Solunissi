<?php

namespace Tests\Feature;

use Tests\TestCase;

class proyectoTest extends TestCase
{

    public function test_actualizarProyecto()
    {
        $data = [
            'almacen_id' => 1,
            'supervisor_id' => 1,
            'fecha_inicio' => '2025-11-06',
            'fecha_fin' => '2025-11-06',
        ];

        $response = $this->putJson('/api/proyecto/1', $data);

        echo $response->getContent();
    }

    public function test_finalizcleararProyecto()
    {
        $response = $this->postJson('/api/proyecto/1/finalizar');
        echo $response->getContent();
    }
}
// php artisan test --filter=proyectoTest::test_finalizcleararProyecto
