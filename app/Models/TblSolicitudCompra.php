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
 * @property int $solicitud_material_id
 * @property int $proyecto_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSolicitudMaterial $tbl_solicitud_material
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
		'solicitud_material_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'solicitud_material_id',
		'proyecto_id',
		'fecha_solicitud',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_solicitud_material()
	{
		return $this->belongsTo(TblSolicitudMaterial::class, 'solicitud_material_id');
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
