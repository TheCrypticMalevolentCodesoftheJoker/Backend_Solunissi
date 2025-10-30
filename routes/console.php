<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('ReiniciarBD', function () {
    $this->info('✨ Iniciando proceso completo de reinicio de base de datos y modelos...');

    $this->info('🧩 Paso 1: Eliminando tablas y aplicando migraciones desde cero...');
    Artisan::call('migrate:refresh');

    $this->info('⚙️ Paso 2: Regenerando los modelos con Reliese...');
    Artisan::call('code:models');

    $this->info('⚠️ Nota: Si vas a usar factories, recuerda agregar "use HasFactory;" en cada modelo.');

    $this->info('✅ Proceso completado correctamente. Estructura de base de datos y modelos actualizados.');
})->purpose('Reinicia la base de datos, aplica migraciones y regenera los modelos.');

Artisan::command('cargarData', function () {
    $this->info('🌱 Cargando datos de prueba...');
    Artisan::call('db:seed');
    $this->info('✅ Datos cargados correctamente.');
})->purpose('Ejecuta los seeders sin modificar la estructura.');

Artisan::command('borrarData', function () {
    $this->info('🧹 Reiniciando base de datos...');
    Artisan::call('migrate:fresh');
    $this->info('✅ Base de datos reiniciada y datos recargados.');
})->purpose('Recrea la base de datos y ejecuta los seeders.');

Artisan::command('codes', function () {
    $this->info('📘 Códigos HTTP para API');

    $codes = [
        '2xx – Éxitos' => [
            '200' => 'OK -> Operación exitosa (GET, PUT/PATCH, DELETE)',
            '201' => 'Created -> Recurso creado con éxito (POST)',
            '202' => 'Accepted -> Solicitud aceptada, aún no procesada completamente',
            '204' => 'No Content -> Éxito pero sin contenido de respuesta (DELETE, PUT)',
        ],
        '3xx – Redirecciones' => [
            '301' => 'Moved Permanently -> Recurso movido permanentemente a otra URL',
            '302' => 'Found -> Recurso temporalmente en otra URL',
            '304' => 'Not Modified -> El recurso no ha cambiado (caché)',
        ],
        '4xx – Errores del cliente' => [
            '400' => 'Bad Request -> La solicitud es inválida o tiene errores de validación',
            '401' => 'Unauthorized -> Autenticación requerida o inválida',
            '403' => 'Forbidden -> No tienes permisos para acceder al recurso',
            '404' => 'Not Found -> Recurso no encontrado',
            '422' => 'Unprocessable Entity -> Error de validación de los datos enviados',
        ],
        '5xx – Errores del servidor' => [
            '500' => 'Internal Server Error -> Error inesperado en el servidor',
            '501' => 'Not Implemented -> Funcionalidad no implementada',
            '503' => 'Service Unavailable -> Servicio no disponible temporalmente',
        ],
    ];

    foreach ($codes as $section => $list) {
        $this->info("\n$section:");
        foreach ($list as $code => $desc) {
            $this->line("  $code = $desc");
        }
    }
})->purpose('Muestra todos los códigos HTTP más comunes y su significado.');