<?php

namespace Tests\Feature;

use Tests\TestCase;

class produccionTest extends TestCase
{
    public function test_registrarPM()
    {
        $data = [
            "proyecto_id" => 2,
            "materiales" => [
                ["material_id" => 1, "cantidad" => 10],
                ["material_id" => 3, "cantidad" => 30],
                ["material_id" => 4, "cantidad" => 20],
            ],
        ];

        $response = $this->postJson('/api/produccion/proyecto-material', $data);

        echo $response->getContent();
    }

    public function test_registrarSolicitudMterial()
    {
        $data = [
            'proyecto_id' => 1,
            'materiales' => [
                [
                    'material_id' => 1,
                    'unidad_medida' => 'rollo',
                    'cantidad' => 140
                ],
                [
                    'material_id' => 2,
                    'unidad_medida' => 'rollo',
                    'cantidad' => 100
                ]
            ]
        ];

        $response = $this->postJson('/api/produccion/solicitud-material', $data);

        echo $response->getContent();
    }

    public function test_registrarPA()
    {
        $data = [
            'proyecto_id' => 1,
            'titulo' => 'Ejecución de cimentación',
            'descripcion' => 'Se ha completado la base estructural del proyecto.',
            'porcentaje_avance' => 100,
        ];

        $response = $this->postJson('/api/produccion/proyecto-avance', $data);

        echo $response->getContent();
    }

    public function test_registrarPI()
    {
        $data = [
            "proyecto_id" => 1,
            "descripcion" => "Se detectó humedad en el área del sótano.",
            "materiales" => [
                ["material_id" => 1, "cantidad" => 10],
                ["material_id" => 2, "cantidad" => 3.5],
            ],
        ];

        $response = $this->postJson('/api/produccion/proyecto-incidencia', $data);

        echo $response->getContent();
    }
}
// php artisan test --filter=produccionTest::test_registrarSolicitudMterial



