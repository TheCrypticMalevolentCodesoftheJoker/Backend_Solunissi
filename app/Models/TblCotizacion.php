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
 * Class TblCotizacion
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $compra_id
 * @property int $proveedor_id
 * @property Carbon $fecha_cotizacion
 * @property float|null $tiempo_entrega_dias
 * @property float|null $costo_envio
 * @property float|null $descuento
 * @property float|null $total
 * @property string $estado
 * 
 * @property TblCompra $tbl_compra
 * @property TblProveedor $tbl_proveedor
 * @property Collection|TblCotizacionDetalle[] $tbl_cotizacion_detalles
 * @property Collection|TblOrdenCompra[] $tbl_orden_compras
 *
 * @package App\Models
 */
class TblCotizacion extends Model
{
    use HasFactory;
	protected $table = 'tbl_cotizacion';
	public $timestamps = false;

	protected $casts = [
		'compra_id' => 'int',
		'proveedor_id' => 'int',
		'fecha_cotizacion' => 'datetime',
		'tiempo_entrega_dias' => 'float',
		'costo_envio' => 'float',
		'descuento' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'codigo',
		'compra_id',
		'proveedor_id',
		'fecha_cotizacion',
		'tiempo_entrega_dias',
		'costo_envio',
		'descuento',
		'total',
		'estado'
	];

	public function tbl_compra()
	{
		return $this->belongsTo(TblCompra::class, 'compra_id');
	}

	public function tbl_proveedor()
	{
		return $this->belongsTo(TblProveedor::class, 'proveedor_id');
	}

	public function tbl_cotizacion_detalles()
	{
		return $this->hasMany(TblCotizacionDetalle::class, 'cotizacion_id');
	}

	public function tbl_orden_compras()
	{
		return $this->hasMany(TblOrdenCompra::class, 'cotizacion_id');
	}
}
