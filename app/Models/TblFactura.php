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
 * Class TblFactura
 * 
 * @property int $id
 * @property int $contrato_id
 * @property string $numero
 * @property Carbon $fecha_emision
 * @property float $monto_total
 * @property string $estado
 * @property int|null $transaccion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblContrato $tbl_contrato
 * @property TblTransaccionContable|null $tbl_transaccion_contable
 * @property Collection|TblDetalleFactura[] $tbl_detalle_facturas
 * @property Collection|TblPago[] $tbl_pagos
 *
 * @package App\Models
 */
class TblFactura extends Model
{
    use HasFactory;
	protected $table = 'tbl_factura';

	protected $casts = [
		'contrato_id' => 'int',
		'fecha_emision' => 'datetime',
		'monto_total' => 'float',
		'transaccion_id' => 'int'
	];

	protected $fillable = [
		'contrato_id',
		'numero',
		'fecha_emision',
		'monto_total',
		'estado',
		'transaccion_id'
	];

	public function tbl_contrato()
	{
		return $this->belongsTo(TblContrato::class, 'contrato_id');
	}

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}

	public function tbl_detalle_facturas()
	{
		return $this->hasMany(TblDetalleFactura::class, 'factura_id');
	}

	public function tbl_pagos()
	{
		return $this->hasMany(TblPago::class, 'factura_id');
	}
}
