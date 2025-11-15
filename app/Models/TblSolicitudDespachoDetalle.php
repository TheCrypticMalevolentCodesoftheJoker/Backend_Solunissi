<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSolicitudDespachoDetalle
 * 
 * @property int $id
 * @property int $solicitud_despacho_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblSolicitudDespacho $tbl_solicitud_despacho
 *
 * @package App\Models
 */
class TblSolicitudDespachoDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_despacho_detalle';
	public $timestamps = false;

	protected $casts = [
		'solicitud_despacho_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'solicitud_despacho_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_solicitud_despacho()
	{
		return $this->belongsTo(TblSolicitudDespacho::class, 'solicitud_despacho_id');
	}
}
