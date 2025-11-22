<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TblProveedor;

class TblProveedorSeeder extends Seeder
{
    public function run(): void
    {
        TblProveedor::create([
            'razon_social'      => 'Tecnología Global SAC',
            'nombre_comercial'  => 'TecnoGlobal',
            'ruc'               => '20123456789',
            'direccion'         => 'Av. Los Ingenieros 123 - Lima',
            'telefono'          => '987654321',
            'correo'            => 'contacto@tecnoglobal.com',
            'pagina_web'        => 'https://www.tecnoglobal.com',
            'contacto_nombre'   => 'Juan Pérez',
            'contacto_telefono' => '912345678',
            'contacto_correo'   => 'jperez@tecnoglobal.com',
            'estado'            => 'Activo',
        ]);

        TblProveedor::create([
            'razon_social'      => 'Constructora Perú SAC',
            'nombre_comercial'  => 'ConstrucPerú',
            'ruc'               => '20654321876',
            'direccion'         => 'Jr. La Unión 450 - Arequipa',
            'telefono'          => '945612378',
            'correo'            => 'ventas@construcperu.com',
            'pagina_web'        => null,
            'contacto_nombre'   => 'María López',
            'contacto_telefono' => '934567890',
            'contacto_correo'   => 'mlopez@construcperu.com',
            'estado'            => 'Activo',
        ]);

        TblProveedor::create([
            'razon_social'      => 'Distribuidora Industrial SRL',
            'nombre_comercial'  => 'Industrias DI',
            'ruc'               => '20456789123',
            'direccion'         => 'Av. Industrial 980 - Trujillo',
            'telefono'          => '956231478',
            'correo'            => 'info@industriasdi.com',
            'pagina_web'        => 'http://www.industriasdi.com',
            'contacto_nombre'   => 'Carlos Guzmán',
            'contacto_telefono' => '987120365',
            'contacto_correo'   => 'cguzman@industriasdi.com',
            'estado'            => 'Activo',
        ]);

        TblProveedor::create([
            'razon_social'      => 'Ferretería San Martín SRL',
            'nombre_comercial'  => 'FerreSanMartín',
            'ruc'               => '20987654321',
            'direccion'         => 'Calle Comercio 220 - Piura',
            'telefono'          => '923456789',
            'correo'            => 'contacto@ferresanmartin.com',
            'pagina_web'        => null,
            'contacto_nombre'   => 'José Ramírez',
            'contacto_telefono' => '987654320',
            'contacto_correo'   => 'jramirez@ferresanmartin.com',
            'estado'            => 'Activo',
        ]);

        TblProveedor::create([
            'razon_social'      => 'Servicios Logísticos Andinos SAC',
            'nombre_comercial'  => 'AndesLogistics',
            'ruc'               => '20111222333',
            'direccion'         => 'Av. Principal 540 - Cusco',
            'telefono'          => '922334455',
            'correo'            => 'info@andeslogistics.com',
            'pagina_web'        => 'https://www.andeslogistics.com',
            'contacto_nombre'   => 'Ana Torres',
            'contacto_telefono' => '911223344',
            'contacto_correo'   => 'atorres@andeslogistics.com',
            'estado'            => 'Activo',
        ]);
    }
}
