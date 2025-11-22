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
 * Class TblSMPendiente
 * 
 * @property int $id
 * @property int $solicitud_material_id
 * @property int $proyecto_id
 * @property Carbon $fecha
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSolicitudMaterial $tbl_solicitud_material
 * @property Collection|TblSMPendienteDetalle[] $tbl_s_m_pendiente_detalles
 *
 * @package App\Models
 */
class TblSMPendiente extends Model
{
    use HasFactory;
	protected $table = 'tbl_s_m_pendiente';
	public $timestamps = false;

	protected $casts = [
		'solicitud_material_id' => 'int',
		'proyecto_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'solicitud_material_id',
		'proyecto_id',
		'fecha',
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

	public function tbl_s_m_pendiente_detalles()
	{
		return $this->hasMany(TblSMPendienteDetalle::class, 's_m_pendiente_id');
	}
}
