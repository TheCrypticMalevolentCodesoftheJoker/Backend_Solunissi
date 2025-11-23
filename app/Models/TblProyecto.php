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
 * Class TblProyecto
 * 
 * @property int $id
 * @property int $contrato_id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property int|null $almacen_id
 * @property int|null $supervisor_id
 * @property Carbon|null $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property float|null $monto_asignado
 * @property float|null $monto_ejecutado
 * @property string|null $estado
 * 
 * @property TblAlmacen|null $tbl_almacen
 * @property TblContrato $tbl_contrato
 * @property TblEmpleado|null $tbl_empleado
 * @property Collection|TblAlmacenMaterial[] $tbl_almacen_materials
 * @property Collection|TblAsistencium[] $tbl_asistencia
 * @property Collection|TblCompra[] $tbl_compras
 * @property Collection|TblDespacho[] $tbl_despachos
 * @property Collection|TblEquipoOperativo[] $tbl_equipo_operativos
 * @property Collection|TblFactura[] $tbl_facturas
 * @property Collection|TblInventarioMovimiento[] $tbl_inventario_movimientos
 * @property Collection|TblProyectoAvance[] $tbl_proyecto_avances
 * @property Collection|TblProyectoIncidencium[] $tbl_proyecto_incidencia
 * @property Collection|TblProyectoMaterial[] $tbl_proyecto_materials
 * @property Collection|TblSoliMat[] $tbl_soli_mats
 * @property Collection|TblSoliMatPend[] $tbl_soli_mat_pends
 * @property Collection|TblTareaProyecto[] $tbl_tarea_proyectos
 * @property Collection|TblTransaccionContable[] $tbl_transaccion_contables
 *
 * @package App\Models
 */
class TblProyecto extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto';
	public $timestamps = false;

	protected $casts = [
		'contrato_id' => 'int',
		'almacen_id' => 'int',
		'supervisor_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'monto_asignado' => 'float',
		'monto_ejecutado' => 'float'
	];

	protected $fillable = [
		'contrato_id',
		'nombre',
		'descripcion',
		'almacen_id',
		'supervisor_id',
		'fecha_inicio',
		'fecha_fin',
		'monto_asignado',
		'monto_ejecutado',
		'estado'
	];

	public function tbl_almacen()
	{
		return $this->belongsTo(TblAlmacen::class, 'almacen_id');
	}

	public function tbl_contrato()
	{
		return $this->belongsTo(TblContrato::class, 'contrato_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'supervisor_id');
	}

	public function tbl_almacen_materials()
	{
		return $this->hasMany(TblAlmacenMaterial::class, 'proyecto_id');
	}

	public function tbl_asistencia()
	{
		return $this->hasMany(TblAsistencium::class, 'proyecto_id');
	}

	public function tbl_compras()
	{
		return $this->hasMany(TblCompra::class, 'proyecto_id');
	}

	public function tbl_despachos()
	{
		return $this->hasMany(TblDespacho::class, 'proyecto_id');
	}

	public function tbl_equipo_operativos()
	{
		return $this->hasMany(TblEquipoOperativo::class, 'proyecto_id');
	}

	public function tbl_facturas()
	{
		return $this->hasMany(TblFactura::class, 'proyecto_id');
	}

	public function tbl_inventario_movimientos()
	{
		return $this->hasMany(TblInventarioMovimiento::class, 'proyecto_id');
	}

	public function tbl_proyecto_avances()
	{
		return $this->hasMany(TblProyectoAvance::class, 'proyecto_id');
	}

	public function tbl_proyecto_incidencia()
	{
		return $this->hasMany(TblProyectoIncidencium::class, 'proyecto_id');
	}

	public function tbl_proyecto_materials()
	{
		return $this->hasMany(TblProyectoMaterial::class, 'proyecto_id');
	}

	public function tbl_soli_mats()
	{
		return $this->hasMany(TblSoliMat::class, 'proyecto_id');
	}

	public function tbl_soli_mat_pends()
	{
		return $this->hasMany(TblSoliMatPend::class, 'proyecto_id');
	}

	public function tbl_tarea_proyectos()
	{
		return $this->hasMany(TblTareaProyecto::class, 'proyecto_id');
	}

	public function tbl_transaccion_contables()
	{
		return $this->hasMany(TblTransaccionContable::class, 'proyecto_id');
	}
}
