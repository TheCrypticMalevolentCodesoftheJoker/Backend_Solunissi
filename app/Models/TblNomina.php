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
 * @property string|null $codigo
 * @property string $periodo
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_fin
 * @property Carbon $fecha_pago
 * @property float $total_nomina
 * @property string $estado
 * 
 * @property Collection|TblBoletaPago[] $tbl_boleta_pagos
 *
 * @package App\Models
 */
class TblNomina extends Model
{
    use HasFactory;
	protected $table = 'tbl_nomina';
	public $timestamps = false;

	protected $casts = [
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'fecha_pago' => 'datetime',
		'total_nomina' => 'float'
	];

	protected $fillable = [
		'codigo',
		'periodo',
		'fecha_inicio',
		'fecha_fin',
		'fecha_pago',
		'total_nomina',
		'estado'
	];

	public function tbl_boleta_pagos()
	{
		return $this->hasMany(TblBoletaPago::class, 'nomina_id');
	}
}
