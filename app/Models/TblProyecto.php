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
 * @property int|null $contrato_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property Carbon $fecha_inicio
 * @property Carbon|null $fecha_fin
 * @property int|null $almacen_id
 * @property int|null $supervisor_id
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblAlmacen|null $tbl_almacen
 * @property TblContrato|null $tbl_contrato
 * @property TblEmpleado|null $tbl_empleado
 * @property Collection|TblAsignacionRecurso[] $tbl_asignacion_recursos
 * @property Collection|TblAsistencium[] $tbl_asistencia
 * @property Collection|TblAvanceProyecto[] $tbl_avance_proyectos
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 * @property Collection|TblEquipoOperativo[] $tbl_equipo_operativos
 * @property Collection|TblIncidenciaCliente[] $tbl_incidencia_clientes
 * @property Collection|TblIncidenciaProduccion[] $tbl_incidencia_produccions
 * @property Collection|TblMovimientoInventario[] $tbl_movimiento_inventarios
 * @property Collection|TblOrdenCompra[] $tbl_orden_compras
 * @property Collection|TblPresupuestoProyecto[] $tbl_presupuesto_proyectos
 * @property Collection|TblSolicitudCompra[] $tbl_solicitud_compras
 * @property Collection|TblStockAlmacen[] $tbl_stock_almacens
 * @property Collection|TblTareaProyecto[] $tbl_tarea_proyectos
 * @property Collection|TblTransaccionContable[] $tbl_transaccion_contables
 * @property Collection|TblViaje[] $tbl_viajes
 *
 * @package App\Models
 */
class TblProyecto extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto';

	protected $casts = [
		'contrato_id' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime',
		'almacen_id' => 'int',
		'supervisor_id' => 'int'
	];

	protected $fillable = [
		'contrato_id',
		'nombre',
		'descripcion',
		'fecha_inicio',
		'fecha_fin',
		'almacen_id',
		'supervisor_id',
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

	public function tbl_asignacion_recursos()
	{
		return $this->hasMany(TblAsignacionRecurso::class, 'proyecto_id');
	}

	public function tbl_asistencia()
	{
		return $this->hasMany(TblAsistencium::class, 'proyecto_id');
	}

	public function tbl_avance_proyectos()
	{
		return $this->hasMany(TblAvanceProyecto::class, 'proyecto_id');
	}

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'proyecto_id');
	}

	public function tbl_equipo_operativos()
	{
		return $this->hasMany(TblEquipoOperativo::class, 'proyecto_id');
	}

	public function tbl_incidencia_clientes()
	{
		return $this->hasMany(TblIncidenciaCliente::class, 'proyecto_id');
	}

	public function tbl_incidencia_produccions()
	{
		return $this->hasMany(TblIncidenciaProduccion::class, 'proyecto_id');
	}

	public function tbl_movimiento_inventarios()
	{
		return $this->hasMany(TblMovimientoInventario::class, 'proyecto_id');
	}

	public function tbl_orden_compras()
	{
		return $this->hasMany(TblOrdenCompra::class, 'proyecto_id');
	}

	public function tbl_presupuesto_proyectos()
	{
		return $this->hasMany(TblPresupuestoProyecto::class, 'proyecto_id');
	}

	public function tbl_solicitud_compras()
	{
		return $this->hasMany(TblSolicitudCompra::class, 'proyecto_id');
	}

	public function tbl_stock_almacens()
	{
		return $this->hasMany(TblStockAlmacen::class, 'proyecto_id');
	}

	public function tbl_tarea_proyectos()
	{
		return $this->hasMany(TblTareaProyecto::class, 'proyecto_id');
	}

	public function tbl_transaccion_contables()
	{
		return $this->hasMany(TblTransaccionContable::class, 'proyecto_id');
	}

	public function tbl_viajes()
	{
		return $this->hasMany(TblViaje::class, 'proyecto_id');
	}
}
