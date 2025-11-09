<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblEquipoOperativoDetalle
 * 
 * @property int $id
 * @property int $equipo_operativo_id
 * @property int $empleado_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblEquipoOperativo $tbl_equipo_operativo
 *
 * @package App\Models
 */
class TblEquipoOperativoDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_equipo_operativo_detalle';

	protected $casts = [
		'equipo_operativo_id' => 'int',
		'empleado_id' => 'int'
	];

	protected $fillable = [
		'equipo_operativo_id',
		'empleado_id'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'empleado_id');
	}

	public function tbl_equipo_operativo()
	{
		return $this->belongsTo(TblEquipoOperativo::class, 'equipo_operativo_id');
	}
}
