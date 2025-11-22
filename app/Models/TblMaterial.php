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
 * @property Collection|TblCotizacionDetalle[] $tbl_cotizacion_detalles
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblInventarioMovimientoDetalle[] $tbl_inventario_movimiento_detalles
 * @property Collection|TblProyectoIncidenciaDetalle[] $tbl_proyecto_incidencia_detalles
 * @property Collection|TblProyectoMaterial[] $tbl_proyecto_materials
 * @property Collection|TblSMPendienteDetalle[] $tbl_s_m_pendiente_detalles
 * @property Collection|TblSolicitudCompraDetalle[] $tbl_solicitud_compra_detalles
 * @property Collection|TblSolicitudDespachoDetalle[] $tbl_solicitud_despacho_detalles
 * @property Collection|TblSolicitudMaterialDetalle[] $tbl_solicitud_material_detalles
 * @property Collection|TblTrasladoDetalle[] $tbl_traslado_detalles
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

	public function tbl_cotizacion_detalles()
	{
		return $this->hasMany(TblCotizacionDetalle::class, 'material_id');
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

	public function tbl_s_m_pendiente_detalles()
	{
		return $this->hasMany(TblSMPendienteDetalle::class, 'material_id');
	}

	public function tbl_solicitud_compra_detalles()
	{
		return $this->hasMany(TblSolicitudCompraDetalle::class, 'material_id');
	}

	public function tbl_solicitud_despacho_detalles()
	{
		return $this->hasMany(TblSolicitudDespachoDetalle::class, 'material_id');
	}

	public function tbl_solicitud_material_detalles()
	{
		return $this->hasMany(TblSolicitudMaterialDetalle::class, 'material_id');
	}

	public function tbl_traslado_detalles()
	{
		return $this->hasMany(TblTrasladoDetalle::class, 'material_id');
	}
}
