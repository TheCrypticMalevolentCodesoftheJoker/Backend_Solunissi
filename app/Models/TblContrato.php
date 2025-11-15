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
 * Class TblContrato
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $cliente_id
 * @property string $tipo_servicio
 * @property string|null $descripcion
 * @property Carbon $fecha_firma
 * @property Carbon|null $fecha_vencimiento
 * @property float $monto_total
 * @property string $estado
 * 
 * @property TblCliente $tbl_cliente
 * @property Collection|TblContratoPago[] $tbl_contrato_pagos
 * @property Collection|TblFactura[] $tbl_facturas
 * @property Collection|TblProyecto[] $tbl_proyectos
 *
 * @package App\Models
 */
class TblContrato extends Model
{
    use HasFactory;
	protected $table = 'tbl_contrato';
	public $timestamps = false;

	protected $casts = [
		'cliente_id' => 'int',
		'fecha_firma' => 'datetime',
		'fecha_vencimiento' => 'datetime',
		'monto_total' => 'float'
	];

	protected $fillable = [
		'codigo',
		'cliente_id',
		'tipo_servicio',
		'descripcion',
		'fecha_firma',
		'fecha_vencimiento',
		'monto_total',
		'estado'
	];

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
	}

	public function tbl_contrato_pagos()
	{
		return $this->hasMany(TblContratoPago::class, 'contrato_id');
	}

	public function tbl_facturas()
	{
		return $this->hasMany(TblFactura::class, 'contrato_id');
	}

	public function tbl_proyectos()
	{
		return $this->hasMany(TblProyecto::class, 'contrato_id');
	}
}
