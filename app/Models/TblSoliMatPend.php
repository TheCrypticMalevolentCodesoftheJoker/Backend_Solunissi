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
 * Class TblSoliMatPend
 * 
 * @property int $id
 * @property int $soli_mat_id
 * @property int $proyecto_id
 * @property string $tipo
 * @property string $estado
 * @property Carbon $fecha
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSoliMat $tbl_soli_mat
 * @property Collection|TblSoliMatPendDet[] $tbl_soli_mat_pend_dets
 *
 * @package App\Models
 */
class TblSoliMatPend extends Model
{
    use HasFactory;
	protected $table = 'tbl_soli_mat_pend';
	public $timestamps = false;

	protected $casts = [
		'soli_mat_id' => 'int',
		'proyecto_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'soli_mat_id',
		'proyecto_id',
		'tipo',
		'estado',
		'fecha'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_soli_mat()
	{
		return $this->belongsTo(TblSoliMat::class, 'soli_mat_id');
	}

	public function tbl_soli_mat_pend_dets()
	{
		return $this->hasMany(TblSoliMatPendDet::class, 'soli_mat_pend_id');
	}
}
