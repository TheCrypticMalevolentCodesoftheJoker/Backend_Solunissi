<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDocumentoContable
 * 
 * @property int $id
 * @property string $tipo
 * @property string $numero
 * @property Carbon $fecha_emision
 * @property float $monto
 * @property int $transaccion_id
 * @property int|null $proveedor_cliente_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblTransaccionContable $tbl_transaccion_contable
 *
 * @package App\Models
 */
class TblDocumentoContable extends Model
{
    use HasFactory;
	protected $table = 'tbl_documento_contable';

	protected $casts = [
		'fecha_emision' => 'datetime',
		'monto' => 'float',
		'transaccion_id' => 'int',
		'proveedor_cliente_id' => 'int'
	];

	protected $fillable = [
		'tipo',
		'numero',
		'fecha_emision',
		'monto',
		'transaccion_id',
		'proveedor_cliente_id'
	];

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}
}
