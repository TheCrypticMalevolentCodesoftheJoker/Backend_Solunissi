<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblIncidenciaProduccion
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $descripcion
 * @property string $tipo
 * @property Carbon $fecha_reporte
 * @property int $responsable_id
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado $tbl_empleado
 *
 * @package App\Models
 */
class TblIncidenciaProduccion extends Model
{
    use HasFactory;
	protected $table = 'tbl_incidencia_produccion';

	protected $casts = [
		'proyecto_id' => 'int',
		'fecha_reporte' => 'datetime',
		'responsable_id' => 'int'
	];

	protected $fillable = [
		'proyecto_id',
		'descripcion',
		'tipo',
		'fecha_reporte',
		'responsable_id',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'responsable_id');
	}
}
