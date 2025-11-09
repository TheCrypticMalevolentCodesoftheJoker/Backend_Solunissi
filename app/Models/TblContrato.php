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
 * @property int $cliente_id
 * @property string $numero
 * @property Carbon $fecha_firma
 * @property float $monto_total
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCliente $tbl_cliente
 * @property Collection|TblFactura[] $tbl_facturas
 * @property Collection|TblProyecto[] $tbl_proyectos
 *
 * @package App\Models
 */
class TblContrato extends Model
{
    use HasFactory;
	protected $table = 'tbl_contrato';

	protected $casts = [
		'cliente_id' => 'int',
		'fecha_firma' => 'datetime',
		'monto_total' => 'float'
	];

	protected $fillable = [
		'cliente_id',
		'numero',
		'fecha_firma',
		'monto_total',
		'estado'
	];

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
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
