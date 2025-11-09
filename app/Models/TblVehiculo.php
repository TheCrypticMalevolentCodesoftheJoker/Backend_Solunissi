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
 * Class TblVehiculo
 * 
 * @property int $id
 * @property string $placa
 * @property string $marca
 * @property string $modelo
 * @property Carbon $anio
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblMantenimientoVehiculo[] $tbl_mantenimiento_vehiculos
 * @property Collection|TblViaje[] $tbl_viajes
 *
 * @package App\Models
 */
class TblVehiculo extends Model
{
    use HasFactory;
	protected $table = 'tbl_vehiculo';

	protected $casts = [
		'anio' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'placa',
		'marca',
		'modelo',
		'anio',
		'estado'
	];

	public function tbl_mantenimiento_vehiculos()
	{
		return $this->hasMany(TblMantenimientoVehiculo::class, 'vehiculo_id');
	}

	public function tbl_viajes()
	{
		return $this->hasMany(TblViaje::class, 'vehiculo_id');
	}
}
