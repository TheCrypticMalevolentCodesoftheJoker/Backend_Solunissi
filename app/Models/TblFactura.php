<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblFactura
 * 
 * @property int $id
 * @property string|null $codigo
 * @property int $contrato_id
 * @property int|null $proyecto_id
 * @property Carbon $fecha_emision
 * @property float $monto_total
 * @property string $estado
 * 
 * @property TblContrato $tbl_contrato
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblFactura extends Model
{
    use HasFactory;
	protected $table = 'tbl_factura';
	public $timestamps = false;

	protected $casts = [
		'contrato_id' => 'int',
		'proyecto_id' => 'int',
		'fecha_emision' => 'datetime',
		'monto_total' => 'float'
	];

	protected $fillable = [
		'codigo',
		'contrato_id',
		'proyecto_id',
		'fecha_emision',
		'monto_total',
		'estado'
	];

	public function tbl_contrato()
	{
		return $this->belongsTo(TblContrato::class, 'contrato_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
