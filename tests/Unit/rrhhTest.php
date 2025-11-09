<?php

namespace Tests\Feature;

use Tests\TestCase;

class rrhhTest extends TestCase
{
    public function test_registrarEmpleado()
    {
        $data = [
            'cargo_id' => 1,
            'dni' => '12345678',
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'email' => 'juan.perez@example.com',
            'telefono' => '+51987654321',
            'direccion' => 'Calle Falsa 123',
            'fecha_ingreso' => '2025-11-06'
        ];

        $response = $this->postJson('/api/rrhh/empleados', $data);

        echo $response->getContent();
    }

    public function test_asignarEquipoOperativo()
    {
        $data = [
            'nombre' => 'Equipo alpha',
            'proyecto_id' => 2,
            'empleado_ids' => [4, 5]
        ];

        $response = $this->postJson('/api/rrhh/equipos-operativos', $data);
        echo $response->getContent();
    }

    public function test_registrarAsistencia()
    {
        $data = [
            "equipo_operativo_id" => 1,
            "proyecto_id" => 2,
            "supervisor_id" => 1,
            "fecha" => "2025-11-07",
            "detalles" => [
                [
                    "empleado_id" => 4,
                    "estado" => "Presente",
                    "horas_extra" => 2,
                    "observacion" => "Llegó puntual"
                ],
                [
                    "empleado_id" => 5,
                    "estado" => "Falta",
                    "horas_extra" => 0,
                    "observacion" => "No avisó"
                ],
            ],
        ];

        $response = $this->postJson('/api/rrhh/asistencia', $data);
        echo $response->getContent();
    }

    public function test_registrarNomina()
    {
        $data = [
            'periodo' => '2025-11',
            'fecha_inicio' => '2025-11-01',
            'fecha_fin' => '2025-11-30',
            'fecha_pago' => '2025-12-01'
        ];

        $response = $this->postJson('/api/rrhh/nomina', $data);
        echo $response->getContent();
    }

    public function test_cerrarNomina()
    {
        $response = $this->postJson("/api/rrhh/nomina/1/cerrar");
        echo $response->getContent();
    }

    public function test_registrarBoleta()
    {
        $boleta = [
            'nomina_id' => 1,
            'empleado_id' => 4,
            'bonos' => 100,
            'descuentos' => 0
        ];

        $response = $this->postJson('/api/rrhh/boleta-pago', $boleta);
        echo $response->getContent();
    }
}
// php artisan test --filter=rrhhTest::test_cerrarNomina
