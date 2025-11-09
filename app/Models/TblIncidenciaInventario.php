<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblIncidenciaInventario
 * 
 * @property int $id
 * @property int $material_id
 * @property int $almacen_id
 * @property string $tipo
 * @property float $cantidad
 * @property string|null $descripcion
 * @property Carbon $fecha_reporte
 * @property int|null $aprobado_por_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblAlmacen $tbl_almacen
 * @property TblEmpleado|null $tbl_empleado
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblIncidenciaInventario extends Model
{
    use HasFactory;
	protected $table = 'tbl_incidencia_inventario';

	protected $casts = [
		'material_id' => 'int',
		'almacen_id' => 'int',
		'cantidad' => 'float',
		'fecha_reporte' => 'datetime',
		'aprobado_por_id' => 'int'
	];

	protected $fillable = [
		'material_id',
		'almacen_id',
		'tipo',
		'cantidad',
		'descripcion',
		'fecha_reporte',
		'aprobado_por_id'
	];

	public function tbl_almacen()
	{
		return $this->belongsTo(TblAlmacen::class, 'almacen_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'aprobado_por_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
