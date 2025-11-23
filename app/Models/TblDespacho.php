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
 * Class TblDespacho
 * 
 * @property int $id
 * @property int $soli_mat_id
 * @property int $proyecto_id
 * @property Carbon $fecha
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSoliMat $tbl_soli_mat
 * @property Collection|TblDespachoDetalle[] $tbl_despacho_detalles
 *
 * @package App\Models
 */
class TblDespacho extends Model
{
    use HasFactory;
	protected $table = 'tbl_despacho';
	public $timestamps = false;

	protected $casts = [
		'soli_mat_id' => 'int',
		'proyecto_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'soli_mat_id',
		'proyecto_id',
		'fecha',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_soli_mat()
	{
		return $this->belongsTo(TblSoliMat::class, 'soli_mat_id');
	}

	public function tbl_despacho_detalles()
	{
		return $this->hasMany(TblDespachoDetalle::class, 'despacho_id');
	}
}
