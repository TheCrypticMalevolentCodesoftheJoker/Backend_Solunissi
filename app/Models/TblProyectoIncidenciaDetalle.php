<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblProyectoIncidenciaDetalle
 * 
 * @property int $id
 * @property int $incidencia_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblProyectoIncidencium $tbl_proyecto_incidencium
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblProyectoIncidenciaDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto_incidencia_detalle';
	public $timestamps = false;

	protected $casts = [
		'incidencia_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'incidencia_id',
		'material_id',
		'cantidad'
	];

	public function tbl_proyecto_incidencium()
	{
		return $this->belongsTo(TblProyectoIncidencium::class, 'incidencia_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
