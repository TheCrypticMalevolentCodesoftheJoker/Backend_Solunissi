<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAlmacenMaterial
 * 
 * @property int $id
 * @property int $almacen_id
 * @property int|null $proyecto_id
 * @property int $material_id
 * @property float $stock
 * @property float $stock_minimo
 * @property float $stock_maximo
 * 
 * @property TblAlmacen $tbl_almacen
 * @property TblMaterial $tbl_material
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblAlmacenMaterial extends Model
{
    use HasFactory;
	protected $table = 'tbl_almacen_material';
	public $timestamps = false;

	protected $casts = [
		'almacen_id' => 'int',
		'proyecto_id' => 'int',
		'material_id' => 'int',
		'stock' => 'float',
		'stock_minimo' => 'float',
		'stock_maximo' => 'float'
	];

	protected $fillable = [
		'almacen_id',
		'proyecto_id',
		'material_id',
		'stock',
		'stock_minimo',
		'stock_maximo'
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
