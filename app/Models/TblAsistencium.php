<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAsistencium
 * 
 * @property int $id
 * @property int $equipo_operativo_id
 * @property int $proyecto_id
 * @property int $supervisor_id
 * @property Carbon $fecha
 * 
 * @property TblEquipoOperativo $tbl_equipo_operativo
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado $tbl_empleado
 * @property Collection|TblAsistenciaDetalle[] $tbl_asistencia_detalles
 *
 * @package App\Models
 */
class TblAsistencium extends Model
{
    use HasFactory;
	protected $table = 'tbl_asistencia';
	public $timestamps = false;

	protected $casts = [
		'equipo_operativo_id' => 'int',
		'proyecto_id' => 'int',
		'supervisor_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'equipo_operativo_id',
		'proyecto_id',
		'supervisor_id',
		'fecha'
	];

	public function tbl_equipo_operativo()
	{
		return $this->belongsTo(TblEquipoOperativo::class, 'equipo_operativo_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'supervisor_id');
	}

	public function tbl_asistencia_detalles()
	{
		return $this->hasMany(TblAsistenciaDetalle::class, 'asistencia_id');
	}
}
