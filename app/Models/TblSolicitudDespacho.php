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
 * Class TblSolicitudDespacho
 * 
 * @property int $id
 * @property int $solicitud_material_id
 * @property int $proyecto_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSolicitudMaterial $tbl_solicitud_material
 * @property Collection|TblSolicitudDespachoDetalle[] $tbl_solicitud_despacho_detalles
 *
 * @package App\Models
 */
class TblSolicitudDespacho extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_despacho';
	public $timestamps = false;

	protected $casts = [
		'solicitud_material_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
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

	public function tbl_solicitud_despacho_detalles()
	{
		return $this->hasMany(TblSolicitudDespachoDetalle::class, 'solicitud_despacho_id');
	}
}
