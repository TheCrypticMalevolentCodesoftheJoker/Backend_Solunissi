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
 * Class TblOrdenCompra
 * 
 * @property int $id
 * @property int $cotizacion_id
 * @property string $numero
 * @property Carbon $fecha_emision
 * @property string $estado
 * @property int $transaccion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCotizacion $tbl_cotizacion
 * @property TblTransaccionContable $tbl_transaccion_contable
 * @property Collection|TblDetalleOrdenCompra[] $tbl_detalle_orden_compras
 *
 * @package App\Models
 */
class TblOrdenCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_orden_compra';

	protected $casts = [
		'cotizacion_id' => 'int',
		'fecha_emision' => 'datetime',
		'transaccion_id' => 'int'
	];

	protected $fillable = [
		'cotizacion_id',
		'numero',
		'fecha_emision',
		'estado',
		'transaccion_id'
	];

	public function tbl_cotizacion()
	{
		return $this->belongsTo(TblCotizacion::class, 'cotizacion_id');
	}

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}

	public function tbl_detalle_orden_compras()
	{
		return $this->hasMany(TblDetalleOrdenCompra::class, 'orden_id');
	}
}
