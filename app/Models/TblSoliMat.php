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
 * Class TblSoliMat
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $proyecto_id
 * @property Carbon|null $fecha_solicitud
 * @property string|null $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property Collection|TblCompra[] $tbl_compras
 * @property Collection|TblDespacho[] $tbl_despachos
 * @property Collection|TblSoliMatDet[] $tbl_soli_mat_dets
 * @property Collection|TblSoliMatPend[] $tbl_soli_mat_pends
 *
 * @package App\Models
 */
class TblSoliMat extends Model
{
    use HasFactory;
	protected $table = 'tbl_soli_mat';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'proyecto_id',
		'fecha_solicitud',
		'estado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_compras()
	{
		return $this->hasMany(TblCompra::class, 'soli_mat_id');
	}

	public function tbl_despachos()
	{
		return $this->hasMany(TblDespacho::class, 'soli_mat_id');
	}

	public function tbl_soli_mat_dets()
	{
		return $this->hasMany(TblSoliMatDet::class, 'soli_mat_id');
	}

	public function tbl_soli_mat_pends()
	{
		return $this->hasMany(TblSoliMatPend::class, 'soli_mat_id');
	}
}
