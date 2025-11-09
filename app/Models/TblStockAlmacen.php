<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblStockAlmacen
 * 
 * @property int $id
 * @property int $almacen_id
 * @property int $material_id
 * @property int|null $proyecto_id
 * @property float $cantidad_disponible
 * @property float $cantidad_reservada
 * @property float $stock_minimo
 * @property float|null $stock_maximo
 * @property Carbon $ultima_actualizacion
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblAlmacen $tbl_almacen
 * @property TblMaterial $tbl_material
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblStockAlmacen extends Model
{
    use HasFactory;
	protected $table = 'tbl_stock_almacen';

	protected $casts = [
		'almacen_id' => 'int',
		'material_id' => 'int',
		'proyecto_id' => 'int',
		'cantidad_disponible' => 'float',
		'cantidad_reservada' => 'float',
		'stock_minimo' => 'float',
		'stock_maximo' => 'float',
		'ultima_actualizacion' => 'datetime',
		'estado' => 'bool'
	];

	protected $fillable = [
		'almacen_id',
		'material_id',
		'proyecto_id',
		'cantidad_disponible',
		'cantidad_reservada',
		'stock_minimo',
		'stock_maximo',
		'ultima_actualizacion',
		'estado'
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
