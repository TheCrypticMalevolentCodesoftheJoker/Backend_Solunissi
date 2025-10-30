<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LimpiarCache extends Command
{
    protected $signature = 'sistema:LimpiarCache';
    protected $description = '⚡ Limpia todas las caches y optimiza el sistema (bootstrap/cache)';

    public function handle()
    {
        $this->info('✨ Iniciando limpieza de cache en bootstrap...');

        $this->info('💫 Limpiando Bootstrap: config...');
        $this->call('config:clear');
        $this->info('👻 Regenerando Bootstrap: config...');
        $this->call('config:cache');

        $this->info('💫 Limpiando Bootstrap: route...');
        $this->call('route:clear');
        $this->info('👻 Regenerando Bootstrap: route...');
        $this->call('route:cache');

        $this->info('💫 Limpiando Bootstrap: view...');
        $this->call('view:clear');
        $this->info('👻 Regenerando Bootstrap: view...');
        $this->call('view:cache');

        $this->info('💫 Limpiando cache de toda la aplicación...');
        $this->call('cache:clear');

        $this->info('👻 Regenerando discovery de paquetes(packages & services)...');
        $this->call('package:discover');

        $this->info('✅ Sistema optimizado correctamente.');
    }
}
