<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDetalleFactura
 * 
 * @property int $id
 * @property int $factura_id
 * @property string $descripcion
 * @property float $cantidad
 * @property float $precio_unitario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblFactura $tbl_factura
 *
 * @package App\Models
 */
class TblDetalleFactura extends Model
{
    use HasFactory;
	protected $table = 'tbl_detalle_factura';

	protected $casts = [
		'factura_id' => 'int',
		'cantidad' => 'float',
		'precio_unitario' => 'float'
	];

	protected $fillable = [
		'factura_id',
		'descripcion',
		'cantidad',
		'precio_unitario'
	];

	public function tbl_factura()
	{
		return $this->belongsTo(TblFactura::class, 'factura_id');
	}
}
