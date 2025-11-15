<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblClienteIncidencium
 * 
 * @property int $id
 * @property int $cliente_id
 * @property Carbon $fecha
 * @property string $tipo
 * @property string|null $asunto
 * @property string|null $detalle
 * @property string|null $prioridad
 * @property string|null $estado
 * 
 * @property TblCliente $tbl_cliente
 *
 * @package App\Models
 */
class TblClienteIncidencium extends Model
{
    use HasFactory;
	protected $table = 'tbl_cliente_incidencia';
	public $timestamps = false;

	protected $casts = [
		'cliente_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'cliente_id',
		'fecha',
		'tipo',
		'asunto',
		'detalle',
		'prioridad',
		'estado'
	];

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
	}
}
