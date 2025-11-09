<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblMantenimientoVehiculo
 * 
 * @property int $id
 * @property int $vehiculo_id
 * @property string $tipo
 * @property string|null $descripcion
 * @property Carbon $fecha_mantenimiento
 * @property float $costo
 * @property int|null $transaccion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblTransaccionContable|null $tbl_transaccion_contable
 * @property TblVehiculo $tbl_vehiculo
 *
 * @package App\Models
 */
class TblMantenimientoVehiculo extends Model
{
    use HasFactory;
	protected $table = 'tbl_mantenimiento_vehiculo';

	protected $casts = [
		'vehiculo_id' => 'int',
		'fecha_mantenimiento' => 'datetime',
		'costo' => 'float',
		'transaccion_id' => 'int'
	];

	protected $fillable = [
		'vehiculo_id',
		'tipo',
		'descripcion',
		'fecha_mantenimiento',
		'costo',
		'transaccion_id'
	];

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}

	public function tbl_vehiculo()
	{
		return $this->belongsTo(TblVehiculo::class, 'vehiculo_id');
	}
}
