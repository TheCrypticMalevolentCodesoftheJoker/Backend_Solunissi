<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDetalleTransaccionContable
 * 
 * @property int $id
 * @property int $transaccion_contable_id
 * @property int $cuenta_contable_id
 * @property float $debe
 * @property float $haber
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCuentaContable $tbl_cuenta_contable
 * @property TblTransaccionContable $tbl_transaccion_contable
 *
 * @package App\Models
 */
class TblDetalleTransaccionContable extends Model
{
    use HasFactory;
	protected $table = 'tbl_detalle_transaccion_contable';

	protected $casts = [
		'transaccion_contable_id' => 'int',
		'cuenta_contable_id' => 'int',
		'debe' => 'float',
		'haber' => 'float'
	];

	protected $fillable = [
		'transaccion_contable_id',
		'cuenta_contable_id',
		'debe',
		'haber'
	];

	public function tbl_cuenta_contable()
	{
		return $this->belongsTo(TblCuentaContable::class, 'cuenta_contable_id');
	}

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_contable_id');
	}
}
