<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblInventarioMovimientoDetalle
 * 
 * @property int $id
 * @property int $inventario_movimiento_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblInventarioMovimientoDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_inventario_movimiento_detalle';
	public $timestamps = false;

	protected $casts = [
		'inventario_movimiento_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'inventario_movimiento_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
