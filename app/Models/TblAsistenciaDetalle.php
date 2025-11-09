<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAsistenciaDetalle
 * 
 * @property int $id
 * @property int $asistencia_id
 * @property int $empleado_id
 * @property string $estado
 * @property float|null $horas_extra
 * @property string|null $observacion
 * 
 * @property TblAsistencium $tbl_asistencium
 * @property TblEmpleado $tbl_empleado
 *
 * @package App\Models
 */
class TblAsistenciaDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_asistencia_detalle';
	public $timestamps = false;

	protected $casts = [
		'asistencia_id' => 'int',
		'empleado_id' => 'int',
		'horas_extra' => 'float'
	];

	protected $fillable = [
		'asistencia_id',
		'empleado_id',
		'estado',
		'horas_extra',
		'observacion'
	];

	public function tbl_asistencium()
	{
		return $this->belongsTo(TblAsistencium::class, 'asistencia_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'empleado_id');
	}
}
