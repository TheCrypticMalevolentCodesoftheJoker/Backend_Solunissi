<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContabilidadControllerTest extends TestCase
{
    public function test_reporteConsolidadoPDF()
    {
        $response = $this->getJson('/api/contabilidad/reporte-consolidado-pdf?periodo=mensual&anio=2025&mes=11');
        file_put_contents(storage_path('app/test_reporte.pdf'), $response->getContent());
    }
}

// php artisan test --filter=ContabilidadControllerTest::test_reporteConsolidadoPDF
