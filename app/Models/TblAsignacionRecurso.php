<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAsignacionRecurso
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property int $empleado_id
 * @property int|null $material_id
 * @property float $cantidad
 * @property Carbon $fecha_asignacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblMaterial|null $tbl_material
 * @property TblProyecto $tbl_proyecto
 *
 * @package App\Models
 */
class TblAsignacionRecurso extends Model
{
    use HasFactory;
	protected $table = 'tbl_asignacion_recurso';

	protected $casts = [
		'proyecto_id' => 'int',
		'empleado_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float',
		'fecha_asignacion' => 'datetime'
	];

	protected $fillable = [
		'proyecto_id',
		'empleado_id',
		'material_id',
		'cantidad',
		'fecha_asignacion'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'empleado_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
