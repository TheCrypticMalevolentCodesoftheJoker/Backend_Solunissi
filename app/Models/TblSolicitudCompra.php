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
 * @property int $proyecto_id
 * @property int $solicitante_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblEmpleado $tbl_empleado
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 *
 * @package App\Models
 */
class TblSolicitudCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_compra';

	protected $casts = [
		'proyecto_id' => 'int',
		'solicitante_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'proyecto_id',
		'solicitante_id',
		'fecha_solicitud',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'solicitante_id');
	}

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'solicitud_id');
	}
}
