<?php

namespace Tests\Feature;

use Tests\TestCase;

class EmpleadoControllerTest extends TestCase
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
}
// php artisan test --filter=EmpleadoControllerTest::test_asignarEquipoOperativo
