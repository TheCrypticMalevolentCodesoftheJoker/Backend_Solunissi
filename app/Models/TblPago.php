<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblPago
 * 
 * @property int $id
 * @property int $factura_id
 * @property Carbon $fecha_pago
 * @property float $monto
 * @property string $metodo_pago
 * @property int|null $transaccion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblFactura $tbl_factura
 * @property TblTransaccionContable|null $tbl_transaccion_contable
 *
 * @package App\Models
 */
class TblPago extends Model
{
    use HasFactory;
	protected $table = 'tbl_pago';

	protected $casts = [
		'factura_id' => 'int',
		'fecha_pago' => 'datetime',
		'monto' => 'float',
		'transaccion_id' => 'int'
	];

	protected $fillable = [
		'factura_id',
		'fecha_pago',
		'monto',
		'metodo_pago',
		'transaccion_id'
	];

	public function tbl_factura()
	{
		return $this->belongsTo(TblFactura::class, 'factura_id');
	}

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}
}
