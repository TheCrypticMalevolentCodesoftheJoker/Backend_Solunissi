<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSolicitudCompraDetalle
 * 
 * @property int $id
 * @property int $solicitud_compra_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblSolicitudCompra $tbl_solicitud_compra
 *
 * @package App\Models
 */
class TblSolicitudCompraDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_solicitud_compra_detalle';
	public $timestamps = false;

	protected $casts = [
		'solicitud_compra_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'solicitud_compra_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_solicitud_compra()
	{
		return $this->belongsTo(TblSolicitudCompra::class, 'solicitud_compra_id');
	}
}
