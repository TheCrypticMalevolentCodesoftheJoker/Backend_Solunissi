<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblViaje
 * 
 * @property int $id
 * @property int $vehiculo_id
 * @property int $ruta_id
 * @property Carbon $fecha_salida
 * @property Carbon|null $fecha_llegada
 * @property int $conductor_id
 * @property int|null $proyecto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblProyecto|null $tbl_proyecto
 * @property TblRutaTransporte $tbl_ruta_transporte
 * @property TblVehiculo $tbl_vehiculo
 *
 * @package App\Models
 */
class TblViaje extends Model
{
    use HasFactory;
	protected $table = 'tbl_viaje';

	protected $casts = [
		'vehiculo_id' => 'int',
		'ruta_id' => 'int',
		'fecha_salida' => 'datetime',
		'fecha_llegada' => 'datetime',
		'conductor_id' => 'int',
		'proyecto_id' => 'int'
	];

	protected $fillable = [
		'vehiculo_id',
		'ruta_id',
		'fecha_salida',
		'fecha_llegada',
		'conductor_id',
		'proyecto_id'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'conductor_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_ruta_transporte()
	{
		return $this->belongsTo(TblRutaTransporte::class, 'ruta_id');
	}

	public function tbl_vehiculo()
	{
		return $this->belongsTo(TblVehiculo::class, 'vehiculo_id');
	}
}
