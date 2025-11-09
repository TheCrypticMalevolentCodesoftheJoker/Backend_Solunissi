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
 * Class TblNomina
 * 
 * @property int $id
 * @property string $periodo
 * @property int $empleado_id
 * @property float $sueldo_base
 * @property float $horas_extra
 * @property float $bonificacion
 * @property float $descuentos
 * @property float $total_pagar
 * @property Carbon $fecha_pago
 * @property int $transaccion_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblTransaccionContable $tbl_transaccion_contable
 * @property Collection|TblBoletaPago[] $tbl_boleta_pagos
 *
 * @package App\Models
 */
class TblNomina extends Model
{
    use HasFactory;
	protected $table = 'tbl_nomina';

	protected $casts = [
		'empleado_id' => 'int',
		'sueldo_base' => 'float',
		'horas_extra' => 'float',
		'bonificacion' => 'float',
		'descuentos' => 'float',
		'total_pagar' => 'float',
		'fecha_pago' => 'datetime',
		'transaccion_id' => 'int'
	];

	protected $fillable = [
		'periodo',
		'empleado_id',
		'sueldo_base',
		'horas_extra',
		'bonificacion',
		'descuentos',
		'total_pagar',
		'fecha_pago',
		'transaccion_id'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'empleado_id');
	}

	public function tbl_transaccion_contable()
	{
		return $this->belongsTo(TblTransaccionContable::class, 'transaccion_id');
	}

	public function tbl_boleta_pagos()
	{
		return $this->hasMany(TblBoletaPago::class, 'nomina_id');
	}
}
