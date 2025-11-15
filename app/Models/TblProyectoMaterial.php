<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblProyectoMaterial
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property int $material_id
 * @property float $cantidad
 * @property Carbon $fecha_asignacion
 * 
 * @property TblMaterial $tbl_material
 * @property TblProyecto $tbl_proyecto
 *
 * @package App\Models
 */
class TblProyectoMaterial extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto_material';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float',
		'fecha_asignacion' => 'datetime'
	];

	protected $fillable = [
		'proyecto_id',
		'material_id',
		'cantidad',
		'fecha_asignacion'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
