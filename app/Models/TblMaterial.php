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
 * @property Collection|TblAlmacenMaterial[] $tbl_almacen_materials
 * @property Collection|TblCompraDetalle[] $tbl_compra_detalles
 * @property Collection|TblCotizacionDetalle[] $tbl_cotizacion_detalles
 * @property Collection|TblDespachoDetalle[] $tbl_despacho_detalles
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblInventarioMovimientoDetalle[] $tbl_inventario_movimiento_detalles
 * @property Collection|TblProyectoIncidenciaDetalle[] $tbl_proyecto_incidencia_detalles
 * @property Collection|TblProyectoMaterial[] $tbl_proyecto_materials
 * @property Collection|TblSoliMatDet[] $tbl_soli_mat_dets
 * @property Collection|TblSoliMatPendDet[] $tbl_soli_mat_pend_dets
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

	public function tbl_almacen_materials()
	{
		return $this->hasMany(TblAlmacenMaterial::class, 'material_id');
	}

	public function tbl_compra_detalles()
	{
		return $this->hasMany(TblCompraDetalle::class, 'material_id');
	}

	public function tbl_cotizacion_detalles()
	{
		return $this->hasMany(TblCotizacionDetalle::class, 'material_id');
	}

	public function tbl_despacho_detalles()
	{
		return $this->hasMany(TblDespachoDetalle::class, 'material_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'material_id');
	}

	public function tbl_inventario_movimiento_detalles()
	{
		return $this->hasMany(TblInventarioMovimientoDetalle::class, 'material_id');
	}

	public function tbl_proyecto_incidencia_detalles()
	{
		return $this->hasMany(TblProyectoIncidenciaDetalle::class, 'material_id');
	}

	public function tbl_proyecto_materials()
	{
		return $this->hasMany(TblProyectoMaterial::class, 'material_id');
	}

	public function tbl_soli_mat_dets()
	{
		return $this->hasMany(TblSoliMatDet::class, 'material_id');
	}

	public function tbl_soli_mat_pend_dets()
	{
		return $this->hasMany(TblSoliMatPendDet::class, 'material_id');
	}
}
