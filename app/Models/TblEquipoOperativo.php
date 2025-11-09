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
 * Class TblEquipoOperativo
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $proyecto_id
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto|null $tbl_proyecto
 * @property Collection|TblAsistencium[] $tbl_asistencia
 * @property Collection|TblEquipoOperativoDetalle[] $tbl_equipo_operativo_detalles
 *
 * @package App\Models
 */
class TblEquipoOperativo extends Model
{
    use HasFactory;
	protected $table = 'tbl_equipo_operativo';

	protected $casts = [
		'proyecto_id' => 'int',
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'proyecto_id',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_asistencia()
	{
		return $this->hasMany(TblAsistencium::class, 'equipo_operativo_id');
	}

	public function tbl_equipo_operativo_detalles()
	{
		return $this->hasMany(TblEquipoOperativoDetalle::class, 'equipo_operativo_id');
	}
}
