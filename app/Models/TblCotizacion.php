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
 * Class TblCotizacion
 * 
 * @property int $id
 * @property int $solicitud_id
 * @property int $proveedor_id
 * @property int $proyecto_id
 * @property Carbon $fecha_cotizacion
 * @property string $estado
 * @property string|null $observacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProveedor $tbl_proveedor
 * @property TblProyecto $tbl_proyecto
 * @property TblSolicitudCompra $tbl_solicitud_compra
 * @property Collection|TblDetalleCotizacion[] $tbl_detalle_cotizacions
 * @property Collection|TblOrdenCompra[] $tbl_orden_compras
 *
 * @package App\Models
 */
class TblCotizacion extends Model
{
    use HasFactory;
	protected $table = 'tbl_cotizacion';

	protected $casts = [
		'solicitud_id' => 'int',
		'proveedor_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_cotizacion' => 'datetime'
	];

	protected $fillable = [
		'solicitud_id',
		'proveedor_id',
		'proyecto_id',
		'fecha_cotizacion',
		'estado',
		'observacion'
	];

	public function tbl_proveedor()
	{
		return $this->belongsTo(TblProveedor::class, 'proveedor_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_solicitud_compra()
	{
		return $this->belongsTo(TblSolicitudCompra::class, 'solicitud_id');
	}

	public function tbl_detalle_cotizacions()
	{
		return $this->hasMany(TblDetalleCotizacion::class, 'cotizacion_id');
	}

	public function tbl_orden_compras()
	{
		return $this->hasMany(TblOrdenCompra::class, 'cotizacion_id');
	}
}
