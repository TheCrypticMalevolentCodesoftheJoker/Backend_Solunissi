<?php

namespace Tests\Feature;

use Tests\TestCase;

class CrmTest extends TestCase
{
    public function test_registrarLead()
    {
        $lead = [
            'nombre'    => 'Juan',
            'apellido'  => 'Pérez',
            'empresa'   => 'Empresa Ejemplo SAC',
            'correo'    => 'contacto@empresa.com',
            'telefono'  => '20123456789',
            'fuente'    => 'Referido'
        ];

        $response = $this->postJson('/api/crm/lead', $lead);

        echo $response->getContent();
    }

    public function test_registrarComunicacion()
    {
        $leadComunicacion = [
            'vendedor_id' => 12,
            'lead_id'     => 1,
            'fecha'       => '2025-11-14',
            'tipo'        => 'Llamada',
            'asunto'      => 'Seguimiento inicial',
            'detalle'     => 'Se realizó llamada de presentación al cliente potencial.'
        ];
        $response = $this->postJson('/api/crm/lead-comunicacion', $leadComunicacion);

        echo $response->getContent();
    }

    public function test_registrarCliente()
    {
        $cliente = [
            'lead_id'        => 1,
            'ruc'            => '20123456789',
            'razon_social'   => 'Empresa Demo SAC',
            'tipo_cliente'   => 'Corporativo',
            'direccion'      => 'Av. Principal 123',
            'pais'           => 'Perú',
            'departamento'   => 'Lima',
            'provincia'      => 'Lima',
            'distrito'       => 'Miraflores',
            'web'            => 'www.empresademo.com',
            'sector'         => 'Tecnología',
            'referencia'     => 'Cliente referenciado por Juan',
            'cargo_contacto' => 'Gerente General',
            'area_contacto'  => 'Ventas',
            'linkedin'       => 'linkedin.com/empresa',
            'facebook'       => 'facebook.com/empresa',
            'twitter'        => '@empresa',
            'instagram'      => '@empresa'
        ];

        $response = $this->postJson('/api/crm/cliente', $cliente);

        echo $response->getContent();
    }

    public function test_registrarIncidencias()
    {
        $incidencia = [
            'cliente_id' => 1,
            'fecha'      => '2025-11-14',
            'tipo'       => 'Reclamo',
            'asunto'     => 'Falla en el servicio',
            'detalle'    => 'El servicio contratado no funciona correctamente desde hace 2 días.',
            'prioridad'  => 'Alta'
        ];

        $response = $this->postJson('/api/crm/cliente-incidencia', $incidencia);

        echo $response->getContent();
    }
}
// php artisan test --filter=CrmTest::test_registrarIncidencias
