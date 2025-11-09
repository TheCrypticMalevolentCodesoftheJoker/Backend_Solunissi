<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblBoletaPago
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $nomina_id
 * @property int $empleado_id
 * @property float $salario_base
 * @property float $horas_extra
 * @property float $bonos
 * @property float $descuentos
 * @property float $neto_pagar
 * @property string $estado
 * 
 * @property TblEmpleado $tbl_empleado
 * @property TblNomina $tbl_nomina
 *
 * @package App\Models
 */
class TblBoletaPago extends Model
{
    use HasFactory;
	protected $table = 'tbl_boleta_pago';
	public $timestamps = false;

	protected $casts = [
		'nomina_id' => 'int',
		'empleado_id' => 'int',
		'salario_base' => 'float',
		'horas_extra' => 'float',
		'bonos' => 'float',
		'descuentos' => 'float',
		'neto_pagar' => 'float'
	];

	protected $fillable = [
		'codigo',
		'nomina_id',
		'empleado_id',
		'salario_base',
		'horas_extra',
		'bonos',
		'descuentos',
		'neto_pagar',
		'estado'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'empleado_id');
	}

	public function tbl_nomina()
	{
		return $this->belongsTo(TblNomina::class, 'nomina_id');
	}
}
