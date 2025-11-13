<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblOrdenCompra
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $proyecto_id
 * @property int $cotizacion_id
 * @property float $total_orden_compra
 * @property Carbon $fecha_emision
 * @property string $estado
 * 
 * @property TblCotizacion $tbl_cotizacion
 * @property TblProyecto $tbl_proyecto
 *
 * @package App\Models
 */
class TblOrdenCompra extends Model
{
    use HasFactory;
	protected $table = 'tbl_orden_compra';
	public $timestamps = false;

	protected $casts = [
		'proyecto_id' => 'int',
		'cotizacion_id' => 'int',
		'total_orden_compra' => 'float',
		'fecha_emision' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'proyecto_id',
		'cotizacion_id',
		'total_orden_compra',
		'fecha_emision',
		'estado'
	];

	public function tbl_cotizacion()
	{
		return $this->belongsTo(TblCotizacion::class, 'cotizacion_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
