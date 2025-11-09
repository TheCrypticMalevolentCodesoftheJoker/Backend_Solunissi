<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblMovimientoInventario
 * 
 * @property int $id
 * @property int $almacen_id
 * @property int $material_id
 * @property int|null $proyecto_id
 * @property string $tipo
 * @property float $cantidad
 * @property string|null $referencia_tipo
 * @property int|null $referencia_id
 * @property Carbon $fecha_movimiento
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblAlmacen $tbl_almacen
 * @property TblMaterial $tbl_material
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblMovimientoInventario extends Model
{
    use HasFactory;
	protected $table = 'tbl_movimiento_inventario';

	protected $casts = [
		'almacen_id' => 'int',
		'material_id' => 'int',
		'proyecto_id' => 'int',
		'cantidad' => 'float',
		'referencia_id' => 'int',
		'fecha_movimiento' => 'datetime'
	];

	protected $fillable = [
		'almacen_id',
		'material_id',
		'proyecto_id',
		'tipo',
		'cantidad',
		'referencia_tipo',
		'referencia_id',
		'fecha_movimiento'
	];

	public function tbl_almacen()
	{
		return $this->belongsTo(TblAlmacen::class, 'almacen_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
