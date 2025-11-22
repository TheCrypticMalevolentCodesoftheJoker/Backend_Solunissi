<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblInventarioMovimiento
 * 
 * @property int $id
 * @property int|null $almacen_origen_id
 * @property int|null $almacen_destino_id
 * @property int|null $proyecto_id
 * @property string $tipo
 * @property string|null $referencia
 * @property string|null $origen_movimiento
 * @property Carbon $fecha_movimiento
 * 
 * @property TblAlmacen|null $tbl_almacen
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblInventarioMovimiento extends Model
{
    use HasFactory;
	protected $table = 'tbl_inventario_movimiento';
	public $timestamps = false;

	protected $casts = [
		'almacen_origen_id' => 'int',
		'almacen_destino_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_movimiento' => 'datetime'
	];

	protected $fillable = [
		'almacen_origen_id',
		'almacen_destino_id',
		'proyecto_id',
		'tipo',
		'referencia',
		'origen_movimiento',
		'fecha_movimiento'
	];

	public function tbl_almacen()
	{
		return $this->belongsTo(TblAlmacen::class, 'almacen_origen_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
