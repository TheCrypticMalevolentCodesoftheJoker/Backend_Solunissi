<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblTareaProyecto
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $descripcion
 * @property int|null $responsable_id
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property int $progreso
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado|null $tbl_empleado
 *
 * @package App\Models
 */
class TblTareaProyecto extends Model
{
    use HasFactory;
	protected $table = 'tbl_tarea_proyecto';

	protected $casts = [
		'proyecto_id' => 'int',
		'responsable_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'progreso' => 'int'
	];

	protected $fillable = [
		'proyecto_id',
		'descripcion',
		'responsable_id',
		'fecha_inicio',
		'fecha_fin',
		'progreso'
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
