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
 * Class TblProyectoIncidencium
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $descripcion
 * @property Carbon $fecha_reporte
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property Collection|TblProyectoIncidenciaDetalle[] $tbl_proyecto_incidencia_detalles
 *
 * @package App\Models
 */
class TblProyectoIncidencium extends Model
{
    use HasFactory;
	protected $table = 'tbl_proyecto_incidencia';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'fecha_reporte' => 'datetime'
	];

	protected $fillable = [
		'proyecto_id',
		'descripcion',
		'fecha_reporte',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_proyecto_incidencia_detalles()
	{
		return $this->hasMany(TblProyectoIncidenciaDetalle::class, 'incidencia_id');
	}
}
