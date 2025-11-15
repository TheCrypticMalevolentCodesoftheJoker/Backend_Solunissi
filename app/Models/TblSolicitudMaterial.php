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
 * Class TblSolicitudMaterial
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property Collection|TblSolicitudCompra[] $tbl_solicitud_compras
 * @property Collection|TblSolicitudDespacho[] $tbl_solicitud_despachos
 * @property Collection|TblSolicitudMaterialDetalle[] $tbl_solicitud_material_detalles
 *
 * @package App\Models
 */
class TblSolicitudMaterial extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_material';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'proyecto_id',
		'fecha_solicitud',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_solicitud_compras()
	{
		return $this->hasMany(TblSolicitudCompra::class, 'solicitud_material_id');
	}

	public function tbl_solicitud_despachos()
	{
		return $this->hasMany(TblSolicitudDespacho::class, 'solicitud_material_id');
	}

	public function tbl_solicitud_material_detalles()
	{
		return $this->hasMany(TblSolicitudMaterialDetalle::class, 'solicitud_material_id');
	}
}
