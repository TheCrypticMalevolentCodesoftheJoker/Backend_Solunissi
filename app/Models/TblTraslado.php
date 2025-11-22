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
 * Class TblTraslado
 * 
 * @property int $id
 * @property int|null $almacen_origen_id
 * @property int|null $almacen_destino_id
 * @property int|null $proyecto_id
 * @property string|null $referencia
 * @property string|null $origen_traslado
 * @property Carbon|null $fecha_traslado
 * @property string|null $estado
 * 
 * @property TblAlmacen|null $tbl_almacen
 * @property TblProyecto|null $tbl_proyecto
 * @property Collection|TblTrasladoDetalle[] $tbl_traslado_detalles
 *
 * @package App\Models
 */
class TblTraslado extends Model
{
    use HasFactory;
	protected $table = 'tbl_traslado';
	public $timestamps = false;

	protected $casts = [
		'almacen_origen_id' => 'int',
		'almacen_destino_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_traslado' => 'datetime'
	];

	protected $fillable = [
		'almacen_origen_id',
		'almacen_destino_id',
		'proyecto_id',
		'referencia',
		'origen_traslado',
		'fecha_traslado',
		'estado'
	];

	public function tbl_almacen()
	{
		return $this->belongsTo(TblAlmacen::class, 'almacen_origen_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}

	public function tbl_traslado_detalles()
	{
		return $this->hasMany(TblTrasladoDetalle::class, 'traslado_id');
	}
}
