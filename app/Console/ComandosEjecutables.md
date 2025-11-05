# ------------------------------------------------------------------------------------
# Levantar servidor
# ------------------------------------------------------------------------------------
php artisan serve

# ------------------------------------------------------------------------------------
# Listar comandos de kernel/console
# ------------------------------------------------------------------------------------
php artisan list

# ------------------------------------------------------------------------------------
# Comandos del sistema
# ------------------------------------------------------------------------------------
php artisan sistema:limpiarFramework
php artisan sistema:LimpiarCache

php artisan sistema:EscanearArquitectura
php artisan sistema:EscanearArquitectura app
php artisan sistema:EscanearArquitectura --LimpiarArquitectura

# ------------------------------------------------------------------------------------
# Comandos de migraciones
# ------------------------------------------------------------------------------------
php artisan make:migration create_tbl_
php artisan migrate
php artisan migrate:install
php artisan migrate:status
php artisan migrate:reset
php artisan migrate:fresh
php artisan migrate:rollback

# ------------------------------------------------------------------------------------
# Comandos de SEEDERS
# ------------------------------------------------------------------------------------
php artisan db:seed
php artisan db:seed --class=ProductosSeeder

# ------------------------------------------------------------------------------------
# Uso de Reliese para generar modelos Eloquent automáticamente
# ------------------------------------------------------------------------------------
composer require reliese/laravel
php artisan vendor:publish --tag=reliese-models
php artisan code:models

* Agregar en los modelos para usar factories
* use HasFactory; // Mantener después de actualizar modelos

