<?php

namespace Tests\Feature;

use Tests\TestCase;


class UserControllerTest extends TestCase
{
    public function test_create_user()
    {
        $payload = [
            'nombre' => 'Uriel',
            'apellidos' => 'Turpo',
            'telefono' => '+51987654321',
            'email' => 'uriel@gmail.com',
            'contrasena' => 'Uriel.71',
            'rolId' => 5
        ];

        $response = $this->postJson('/api/user', $payload);
        echo $response->getContent();
    }

    public function test_update_user()
    {
        $payload = [
            'nombre' => 'Uriel',
            'apellidos' => 'turpo',
            'telefono' => '',
            'email' => 'Erison@gmail.com',
            'contrasena' => 'Erinson.71',
            'estado' => true,
            'rolId' => 1
        ];

        $response = $this->putJson('/api/user/1', $payload);
        echo $response->getContent();
    }

    public function test_delete_user()
    {
        $userId = 1;
        $response = $this->deleteJson("/api/user/{$userId}");

        echo $response->getContent();
    }
}
// php artisan test --filter=UserControllerTest::test_create_user
