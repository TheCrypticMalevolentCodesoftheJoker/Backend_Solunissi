<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDetalleCotizacion
 * 
 * @property int $id
 * @property int $cotizacion_id
 * @property int $material_id
 * @property float $cantidad
 * @property float $precio_unitario
 * @property float $subtotal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCotizacion $tbl_cotizacion
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblDetalleCotizacion extends Model
{
    use HasFactory;
	protected $table = 'tbl_detalle_cotizacion';

	protected $casts = [
		'cotizacion_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float',
		'precio_unitario' => 'float',
		'subtotal' => 'float'
	];

	protected $fillable = [
		'cotizacion_id',
		'material_id',
		'cantidad',
		'precio_unitario',
		'subtotal'
	];

	public function tbl_cotizacion()
	{
		return $this->belongsTo(TblCotizacion::class, 'cotizacion_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
