<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAvanceProyecto
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $descripcion
 * @property int $porcentaje_avance
 * @property Carbon $fecha_registro
 * @property int $registrado_por
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado $tbl_empleado
 *
 * @package App\Models
 */
class TblAvanceProyecto extends Model
{
    use HasFactory;
	protected $table = 'tbl_avance_proyecto';

	protected $casts = [
		'proyecto_id' => 'int',
		'porcentaje_avance' => 'int',
		'fecha_registro' => 'datetime',
		'registrado_por' => 'int'
	];

	protected $fillable = [
		'proyecto_id',
		'descripcion',
		'porcentaje_avance',
		'fecha_registro',
		'registrado_por'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'registrado_por');
	}
}
