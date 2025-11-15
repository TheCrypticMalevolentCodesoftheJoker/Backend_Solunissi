<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblProyectoAvance
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $titulo
 * @property string $descripcion
 * @property Carbon $fecha_registro
 * @property int $porcentaje_avance
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 *
 * @package App\Models
 */
class TblProyectoAvance extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto_avance';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'fecha_registro' => 'datetime',
		'porcentaje_avance' => 'int'
	];

	protected $fillable = [
		'proyecto_id',
		'titulo',
		'descripcion',
		'fecha_registro',
		'porcentaje_avance',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
