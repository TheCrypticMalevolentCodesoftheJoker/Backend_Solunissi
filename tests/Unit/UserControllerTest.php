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
            'rolID' => 5
        ];

        $response = $this->postJson('/api/user', $payload);
        echo $response->getContent();
    }

    public function test_update_user()
    {
        $payload = [
            'nombre' => 'Uriel',
            'apellidos' => 'Mamani',
            'telefono' => '+51987654321',
            'email' => 'uriel@gmail.com',
            'contrasena' => 'Uriel.71',
            'estado' => true,
            'rolID' => 1
        ];

        $response = $this->putJson('/api/user/6', $payload);
        echo $response->getContent();
    }

    public function test_delete_user()
    {
        $response = $this->deleteJson("/api/user/6");

        echo $response->getContent();
    }

    public function test_login_user()
    {
        $loginData = [
            'email' => 'uriel@gmail.com',
            'contrasena' => 'Uriel.71'
        ];

        $response = $this->postJson('/api/auth/login', $loginData);

        echo $response->getContent();
    }
}
// php artisan test --filter=UserControllerTest::test_login_user
