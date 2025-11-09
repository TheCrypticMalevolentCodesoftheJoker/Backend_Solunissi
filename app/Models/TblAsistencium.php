<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAsistencium
 * 
 * @property int $id
 * @property int $empleado_id
 * @property int $supervisor_id
 * @property int|null $proyecto_id
 * @property Carbon $fecha
 * @property float|null $horas_extra
 * @property string $estado
 * @property string|null $observacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblAsistencium extends Model
{
    use HasFactory;
	protected $table = 'tbl_asistencia';

	protected $casts = [
		'empleado_id' => 'int',
		'supervisor_id' => 'int',
		'proyecto_id' => 'int',
		'fecha' => 'datetime',
		'horas_extra' => 'float'
	];

	protected $fillable = [
		'empleado_id',
		'supervisor_id',
		'proyecto_id',
		'fecha',
		'horas_extra',
		'estado',
		'observacion'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'supervisor_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
