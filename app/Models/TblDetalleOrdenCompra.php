<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDetalleOrdenCompra
 * 
 * @property int $id
 * @property int $orden_id
 * @property int $material_id
 * @property float $cantidad
 * @property float $precio_unitario
 * @property float $subtotal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblMaterial $tbl_material
 * @property TblOrdenCompra $tbl_orden_compra
 *
 * @package App\Models
 */
class TblDetalleOrdenCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_detalle_orden_compra';

	protected $casts = [
		'orden_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float',
		'precio_unitario' => 'float',
		'subtotal' => 'float'
	];

	protected $fillable = [
		'orden_id',
		'material_id',
		'cantidad',
		'precio_unitario',
		'subtotal'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_orden_compra()
	{
		return $this->belongsTo(TblOrdenCompra::class, 'orden_id');
	}
}
