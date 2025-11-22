<?php

namespace Tests\Feature;

use Tests\TestCase;


class UserControllerTest extends TestCase
{
    public function test_create_user()
    {
        $payload = [
            'nombre' => 'fredy',
            'apellidos' => 'javier',
            'telefono' => '+51987654321',
            'email' => 'frey@gmail.com',
            'contrasena' => 'Uriel.71',
            'rolID' => 5
        ];

        $response = $this->postJson('/api/user', $payload);
        echo $response->getContent();
    }

    public function test_update_user()
    {
        $payload = [
            'nombre' => 'erison',
            'apellidos' => 'Mamani',
            'telefono' => '+51987654321',
            'email' => 'erison@gmail.com',
            'contrasena' => 'Uriel.71',
            'estado' => true,
            'rolID' => 1
        ];

        $response = $this->putJson('/api/user/7', $payload);
        echo $response->getContent();
    }

    public function test_delete_user()
    {
        $response = $this->deleteJson("/api/user/7");

        echo $response->getContent();
    }

    public function test_login_user()
    {
        $loginData = [
            'email' => 'uriel@gmail.com',
            'contrasena' => 'Uriel.12'
        ];

        $response = $this->postJson('/api/autenticacion/login', $loginData);

        echo $response->getContent();
    }
}
// php artisan test --filter=UserControllerTest::test_login_user
