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
 * Class TblMaterial
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $unidad_medida
 * @property int $stock_minimo
 * @property int|null $stock_maximo
 * @property float $precio_unitario
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblAsignacionRecurso[] $tbl_asignacion_recursos
 * @property Collection|TblDetalleCotizacion[] $tbl_detalle_cotizacions
 * @property Collection|TblDetalleOrdenCompra[] $tbl_detalle_orden_compras
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblMovimientoInventario[] $tbl_movimiento_inventarios
 * @property Collection|TblStockAlmacen[] $tbl_stock_almacens
 *
 * @package App\Models
 */
class TblMaterial extends Model
{
    use HasFactory;
	protected $table = 'tbl_material';

	protected $casts = [
		'stock_minimo' => 'int',
		'stock_maximo' => 'int',
		'precio_unitario' => 'float',
		'estado' => 'bool'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'descripcion',
		'unidad_medida',
		'stock_minimo',
		'stock_maximo',
		'precio_unitario',
		'estado'
	];

	public function tbl_asignacion_recursos()
	{
		return $this->hasMany(TblAsignacionRecurso::class, 'material_id');
	}

	public function tbl_detalle_cotizacions()
	{
		return $this->hasMany(TblDetalleCotizacion::class, 'material_id');
	}

	public function tbl_detalle_orden_compras()
	{
		return $this->hasMany(TblDetalleOrdenCompra::class, 'material_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'material_id');
	}

	public function tbl_movimiento_inventarios()
	{
		return $this->hasMany(TblMovimientoInventario::class, 'material_id');
	}

	public function tbl_stock_almacens()
	{
		return $this->hasMany(TblStockAlmacen::class, 'material_id');
	}
}
