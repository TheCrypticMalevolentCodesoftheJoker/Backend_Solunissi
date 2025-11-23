<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblCompraDetalle
 * 
 * @property int $id
 * @property int $compra_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblCompra $tbl_compra
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblCompraDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_compra_detalle';
	public $timestamps = false;

	protected $casts = [
		'compra_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'compra_id',
		'material_id',
		'cantidad'
	];

	public function tbl_compra()
	{
		return $this->belongsTo(TblCompra::class, 'compra_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
