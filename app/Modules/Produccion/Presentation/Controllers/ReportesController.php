<?php

namespace Modules\Produccion\Presentation\Controllers;

use App\Models\TblProyecto;
use App\Models\TblProyectoMaterial;
use App\Models\TblProyectoAvance;
use App\Models\TblProyectoIncidencium;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function reportePDF($id)
    {
        try {
            DB::beginTransaction();
            $proyecto = TblProyecto::findOrFail($id);

            $materiales = TblProyectoMaterial::with('tbl_material:id,nombre,unidad_medida')
                ->where('proyecto_id', $id)
                ->get();

            $avances = TblProyectoAvance::where('proyecto_id', $id)->get();

            $incidencias = TblProyectoIncidencium::with([
                'tbl_empleado:id,nombres,apellidos',
                'tbl_proyecto_incidencia_detalles.tbl_material:id,nombre,unidad_medida'
            ])->where('proyecto_id', $id)->get();

            $html = '
                <h1 style="text-align:center;">REPORTE DEL PROYECTO</h1>
                <h2 style="text-align:center;">' . $proyecto->nombre . '</h2>
                <p><strong>Fecha de Inicio:</strong> ' . $proyecto->fecha_inicio . ' |
                   <strong>Fecha de Fin:</strong> ' . $proyecto->fecha_fin . '</p>
                <hr>

                <h3>1. Materiales Asignados</h3>
                <table width="100%" border="1" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th>Material</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                            <th>Fecha Asignación</th>
                        </tr>
                    </thead>
                    <tbody>';

            if ($materiales->count() > 0) {
                foreach ($materiales as $m) {
                    $html .= '<tr>
                        <td>' . $m->tbl_material->nombre . '</td>
                        <td>' . $m->tbl_material->unidad_medida . '</td>
                        <td>' . $m->cantidad . '</td>
                        <td>' . $m->fecha_asignacion->format('d/m/Y') . '</td>
                    </tr>';
                }
            } else {
                $html .= '<tr><td colspan="4" align="center">No hay materiales asignados</td></tr>';
            }

            $html .= '</tbody></table><br><hr>';

            // Avances del proyecto
            $html .= '<h3>2. Avances del Proyecto</h3>
                <table width="100%" border="1" cellspacing="0" cellpadding="4">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>% Avance</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>';

            if ($avances->count() > 0) {
                foreach ($avances as $a) {
                    $html .= '<tr>
                        <td>' . $a->titulo . '</td>
                        <td>' . $a->descripcion . '</td>
                        <td>' . $a->porcentaje_avance . '%</td>
                        <td>' . $a->estado . '</td>
                        <td>' . $a->fecha_registro->format('d/m/Y') . '</td>
                    </tr>';
                }
            } else {
                $html .= '<tr><td colspan="5" align="center">No hay avances registrados</td></tr>';
            }

            $html .= '</tbody></table><br><hr>';

            // Incidencias
            $html .= '<h3>3. Incidencias del Proyecto</h3>';

            if ($incidencias->count() > 0) {
                foreach ($incidencias as $i) {
                    $html .= '
                        <p><strong>Supervisor:</strong> ' . $i->tbl_empleado->nombres . ' ' . $i->tbl_empleado->apellidos . '</p>
                        <p><strong>Descripción:</strong> ' . $i->descripcion . '</p>
                        <p><strong>Fecha:</strong> ' . $i->fecha_reporte->format('d/m/Y') . ' |
                           <strong>Estado:</strong> ' . $i->estado . '</p>';

                    if ($i->tbl_proyecto_incidencia_detalles->count() > 0) {
                        $html .= '<table width="100%" border="1" cellspacing="0" cellpadding="4">
                            <thead>
                                <tr style="background-color:#f2f2f2;">
                                    <th>Material</th>
                                    <th>Unidad</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead><tbody>';

                        foreach ($i->tbl_proyecto_incidencia_detalles as $d) {
                            $html .= '<tr>
                                <td>' . $d->tbl_material->nombre . '</td>
                                <td>' . $d->tbl_material->unidad_medida . '</td>
                                <td>' . $d->cantidad . '</td>
                            </tr>';
                        }

                        $html .= '</tbody></table><br>';
                    }

                    $html .= '<hr>';
                }
            } else {
                $html .= '<p align="center">No se registraron incidencias.</p>';
            }

            // Generar el PDF
            $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

            DB::commit();

            return $pdf->stream('Reporte_Proyecto_' . $proyecto->nombre . '.pdf');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
