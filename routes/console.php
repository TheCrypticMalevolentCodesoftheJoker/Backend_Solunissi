<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

Artisan::command('borrarData', function () {
    $this->info('✨ Eliminando modelos antiguos en app/Models...');
    $modelsPath = app_path('Models');
    if (File::exists($modelsPath)) {
        $files = File::files($modelsPath);
        foreach ($files as $file) {
            File::delete($file);
        }
    }

    $this->info('✨ Aplicando migraciones desde cero...');
    Artisan::call('migrate:fresh');

    $this->info('✨ Generando modelos con Reliese...');
    Artisan::call('code:models');

    $this->info('✨ Agregando "use HasFactory;" a cada modelo...');
    $modelFiles = File::files($modelsPath);
    foreach ($modelFiles as $file) {
        $contents = File::get($file);

        if (!str_contains($contents, 'HasFactory')) {
            $contents = str_replace(
                'use Illuminate\Database\Eloquent\Model;',
                "use Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\Factories\HasFactory;",
                $contents
            );

            $contents = preg_replace_callback(
                '/class (\w+) extends Model\s*\{/',
                function ($matches) {
                    return $matches[0] . "\n    use HasFactory;";
                },
                $contents,
                1
            );

            File::put($file, $contents);
        }
    }


    $this->info('✅ Proceso finalizado exitosamente.');
})->purpose('Reinicia la base de datos, aplica migraciones, regenera modelos y agrega HasFactory.');

Artisan::command('cargarData', function () {
    $this->info('✨ Cargando datos de prueba...');
    Artisan::call('db:seed');
    
    $this->info('✅ Datos cargados exitosamente.');
})->purpose('Ejecuta los seeders sin modificar la estructura.');

Artisan::command('codes', function () {
    $this->info('✨ Códigos HTTP para API');

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

Artisan::command('uriel', function () {
    $this->info('✨ Inspiración para ti');

    $mensajes = [
        '“Programar es como contarle un secreto a una computadora y esperar que lo entienda.”',
        '“Debugging: El arte de eliminar errores que ni sabías que existían.”',
        '“Todo código que no rompe nada, probablemente no hace nada.”',
        '“Commit temprano, commit frecuente, commit feliz.”',
        '“Si funciona, no lo toques. Si no funciona, bueno… toca todo.”',
        '“Programar es la forma más divertida de hacer malabares con la lógica.”',
        '“Los programadores no se equivocan, solo crean características inesperadas.”',
        '“La documentación es como el aceite: nadie la ve hasta que algo se traba.”',
        '“Escribir código limpio es un arte, tu yo del futuro te lo agradecerá.”',
        '“Siempre hay un bug escondido… y siempre hay café cerca.”',
    ];

    $mensajeAleatorio = $mensajes[array_rand($mensajes)];

    $this->line("💡 Inspiración: $mensajeAleatorio");
})->purpose('Muestra un mensaje inspirador aleatorio para programadores');

Artisan::command('rutas', function () {
    $this->info("\n📌 Listado de rutas cargadas:\n");
    $this->call('route:list');
})->describe('Muestra un listado de todas las rutas registradas en la aplicación');