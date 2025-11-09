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
 * Class TblAlmacen
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $ubicacion
 * @property int|null $responsable_id
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblEmpleado|null $tbl_empleado
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblMovimientoInventario[] $tbl_movimiento_inventarios
 * @property Collection|TblProyecto[] $tbl_proyectos
 * @property Collection|TblStockAlmacen[] $tbl_stock_almacens
 *
 * @package App\Models
 */
class TblAlmacen extends Model
{
    use HasFactory;
	protected $table = 'tbl_almacen';

	protected $casts = [
		'responsable_id' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'ubicacion',
		'responsable_id',
		'estado'
	];

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'responsable_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'almacen_id');
	}

	public function tbl_movimiento_inventarios()
	{
		return $this->hasMany(TblMovimientoInventario::class, 'almacen_id');
	}

	public function tbl_proyectos()
	{
		return $this->hasMany(TblProyecto::class, 'almacen_id');
	}

	public function tbl_stock_almacens()
	{
		return $this->hasMany(TblStockAlmacen::class, 'almacen_id');
	}
}
