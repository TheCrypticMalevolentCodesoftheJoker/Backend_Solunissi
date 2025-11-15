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
 * Class TblEmpleado
 * 
 * @property int $id
 * @property int $cargo_id
 * @property string $dni
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string|null $telefono
 * @property string|null $direccion
 * @property Carbon $fecha_ingreso
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCargo $tbl_cargo
 * @property Collection|TblAsistencium[] $tbl_asistencia
 * @property Collection|TblAsistenciaDetalle[] $tbl_asistencia_detalles
 * @property Collection|TblBoletaPago[] $tbl_boleta_pagos
 * @property Collection|TblEquipoOperativoDetalle[] $tbl_equipo_operativo_detalles
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblLeadComunicacion[] $tbl_lead_comunicacions
 * @property Collection|TblProyecto[] $tbl_proyectos
 * @property Collection|TblProyectoIncidencium[] $tbl_proyecto_incidencia
 * @property Collection|TblTareaProyecto[] $tbl_tarea_proyectos
 *
 * @package App\Models
 */
class TblEmpleado extends Model
{
    use HasFactory;
	protected $table = 'tbl_empleado';

	protected $casts = [
		'cargo_id' => 'int',
		'fecha_ingreso' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'cargo_id',
		'dni',
		'nombres',
		'apellidos',
		'email',
		'telefono',
		'direccion',
		'fecha_ingreso',
		'estado'
	];

	public function tbl_cargo()
	{
		return $this->belongsTo(TblCargo::class, 'cargo_id');
	}

	public function tbl_asistencia()
	{
		return $this->hasMany(TblAsistencium::class, 'supervisor_id');
	}

	public function tbl_asistencia_detalles()
	{
		return $this->hasMany(TblAsistenciaDetalle::class, 'empleado_id');
	}

	public function tbl_boleta_pagos()
	{
		return $this->hasMany(TblBoletaPago::class, 'empleado_id');
	}

	public function tbl_equipo_operativo_detalles()
	{
		return $this->hasMany(TblEquipoOperativoDetalle::class, 'empleado_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'aprobado_por_id');
	}

	public function tbl_lead_comunicacions()
	{
		return $this->hasMany(TblLeadComunicacion::class, 'vendedor_id');
	}

	public function tbl_proyectos()
	{
		return $this->hasMany(TblProyecto::class, 'supervisor_id');
	}

	public function tbl_proyecto_incidencia()
	{
		return $this->hasMany(TblProyectoIncidencium::class, 'supervisor_id');
	}

	public function tbl_tarea_proyectos()
	{
		return $this->hasMany(TblTareaProyecto::class, 'responsable_id');
	}
}
