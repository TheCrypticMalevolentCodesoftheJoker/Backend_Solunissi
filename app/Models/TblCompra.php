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
 * Class TblCompra
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $soli_mat_id
 * @property int $proyecto_id
 * @property Carbon $fecha_solicitud
 * @property string $estado
 * 
 * @property TblProyecto $tbl_proyecto
 * @property TblSoliMat $tbl_soli_mat
 * @property Collection|TblCompraDetalle[] $tbl_compra_detalles
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 *
 * @package App\Models
 */
class TblCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_compra';
	public $timestamps = false;

	protected $casts = [
		'soli_mat_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_solicitud' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'soli_mat_id',
		'proyecto_id',
		'fecha_solicitud',
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

	public function tbl_compra_detalles()
	{
		return $this->hasMany(TblCompraDetalle::class, 'compra_id');
	}

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'compra_id');
	}
}
