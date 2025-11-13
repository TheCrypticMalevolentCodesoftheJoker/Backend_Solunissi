<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblMaterial
 * 
 * @property int $id
 * @property string|null $codigo
 * @property string $nombre
 * @property string $unidad_medida
 * 
 * @property Collection|TblAsignacionRecurso[] $tbl_asignacion_recursos
 * @property Collection|TblCotizacionDetalle[] $tbl_cotizacion_detalles
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblMovimientoInventario[] $tbl_movimiento_inventarios
 * @property Collection|TblSolicitudCompraDetalle[] $tbl_solicitud_compra_detalles
 * @property Collection|TblStockAlmacen[] $tbl_stock_almacens
 *
 * @package App\Models
 */
class TblMaterial extends Model
{
    use HasFactory;
	protected $table = 'tbl_material';
	public $timestamps = false;

	protected $fillable = [
		'codigo',
		'nombre',
		'unidad_medida'
	];

	public function tbl_asignacion_recursos()
	{
		return $this->hasMany(TblAsignacionRecurso::class, 'material_id');
	}

	public function tbl_cotizacion_detalles()
	{
		return $this->hasMany(TblCotizacionDetalle::class, 'material_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'material_id');
	}

	public function tbl_movimiento_inventarios()
	{
		return $this->hasMany(TblMovimientoInventario::class, 'material_id');
	}

	public function tbl_solicitud_compra_detalles()
	{
		return $this->hasMany(TblSolicitudCompraDetalle::class, 'material_id');
	}

	public function tbl_stock_almacens()
	{
		return $this->hasMany(TblStockAlmacen::class, 'material_id');
	}
}
