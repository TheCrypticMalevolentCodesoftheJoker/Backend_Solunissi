<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSolicitudMaterialDetalle
 * 
 * @property int $id
 * @property int $solicitud_material_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblSolicitudMaterial $tbl_solicitud_material
 *
 * @package App\Models
 */
class TblSolicitudMaterialDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_material_detalle';
	public $timestamps = false;

	protected $casts = [
		'solicitud_material_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'solicitud_material_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_solicitud_material()
	{
		return $this->belongsTo(TblSolicitudMaterial::class, 'solicitud_material_id');
	}
}
