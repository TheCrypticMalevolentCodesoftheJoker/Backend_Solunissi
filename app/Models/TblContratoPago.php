<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblContratoPago
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $contrato_id
 * @property float $monto
 * @property Carbon $fecha_pago
 * @property string $medio_pago
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblContrato $tbl_contrato
 *
 * @package App\Models
 */
class TblContratoPago extends Model
{
    use HasFactory;
	protected $table = 'tbl_contrato_pago';

	protected $casts = [
		'contrato_id' => 'int',
		'monto' => 'float',
		'fecha_pago' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'contrato_id',
		'monto',
		'fecha_pago',
		'medio_pago',
		'estado'
	];

	public function tbl_contrato()
	{
		return $this->belongsTo(TblContrato::class, 'contrato_id');
	}
}
