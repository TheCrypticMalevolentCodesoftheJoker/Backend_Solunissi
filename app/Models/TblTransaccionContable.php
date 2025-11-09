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
 * Class TblTransaccionContable
 * 
 * @property int $id
 * @property Carbon $fecha_registro
 * @property int|null $proyecto_id
 * @property int $tipo_transaccion_contable_id
 * @property int $centro_costo_id
 * @property float $monto_total
 * @property string|null $modulo_origen
 * @property int|null $referencia_id
 * @property string|null $descripcion
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCentroCosto $tbl_centro_costo
 * @property TblProyecto|null $tbl_proyecto
 * @property TblTipoTransaccionContable $tbl_tipo_transaccion_contable
 * @property Collection|TblDetalleTransaccionContable[] $tbl_detalle_transaccion_contables
 * @property Collection|TblDocumentoContable[] $tbl_documento_contables
 * @property Collection|TblFactura[] $tbl_facturas
 * @property Collection|TblMantenimientoVehiculo[] $tbl_mantenimiento_vehiculos
 * @property Collection|TblNomina[] $tbl_nominas
 * @property Collection|TblOrdenCompra[] $tbl_orden_compras
 * @property Collection|TblPago[] $tbl_pagos
 *
 * @package App\Models
 */
class TblTransaccionContable extends Model
{
    use HasFactory;
	protected $table = 'tbl_transaccion_contable';

	protected $casts = [
		'fecha_registro' => 'datetime',
		'proyecto_id' => 'int',
		'tipo_transaccion_contable_id' => 'int',
		'centro_costo_id' => 'int',
		'monto_total' => 'float',
		'referencia_id' => 'int'
	];

	protected $fillable = [
		'fecha_registro',
		'proyecto_id',
		'tipo_transaccion_contable_id',
		'centro_costo_id',
		'monto_total',
		'modulo_origen',
		'referencia_id',
		'descripcion',
		'estado'
	];

	public function tbl_centro_costo()
	{
		return $this->belongsTo(TblCentroCosto::class, 'centro_costo_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_tipo_transaccion_contable()
	{
		return $this->belongsTo(TblTipoTransaccionContable::class, 'tipo_transaccion_contable_id');
	}

	public function tbl_detalle_transaccion_contables()
	{
		return $this->hasMany(TblDetalleTransaccionContable::class, 'transaccion_contable_id');
	}

	public function tbl_documento_contables()
	{
		return $this->hasMany(TblDocumentoContable::class, 'transaccion_id');
	}

	public function tbl_facturas()
	{
		return $this->hasMany(TblFactura::class, 'transaccion_id');
	}

	public function tbl_mantenimiento_vehiculos()
	{
		return $this->hasMany(TblMantenimientoVehiculo::class, 'transaccion_id');
	}

	public function tbl_nominas()
	{
		return $this->hasMany(TblNomina::class, 'transaccion_id');
	}

	public function tbl_orden_compras()
	{
		return $this->hasMany(TblOrdenCompra::class, 'transaccion_id');
	}

	public function tbl_pagos()
	{
		return $this->hasMany(TblPago::class, 'transaccion_id');
	}
}
