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
 * Class TblSolicitudCompra
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $proyecto_id
 * @property int $supervisor_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado $tbl_empleado
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 * @property Collection|TblSolicitudCompraDetalle[] $tbl_solicitud_compra_detalles
 *
 * @package App\Models
 */
class TblSolicitudCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_compra';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'supervisor_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'proyecto_id',
		'supervisor_id',
		'fecha_solicitud',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'supervisor_id');
	}

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'solicitud_compra_id');
	}

	public function tbl_solicitud_compra_detalles()
	{
		return $this->hasMany(TblSolicitudCompraDetalle::class, 'solicitud_compra_id');
	}
}
