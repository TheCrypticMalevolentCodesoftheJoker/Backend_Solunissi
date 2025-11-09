<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblIncidenciaCliente
 * 
 * @property int $id
 * @property int $cliente_id
 * @property string $tipo
 * @property string $descripcion
 * @property Carbon $fecha_reporte
 * @property string $estado
 * @property int|null $proyecto_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCliente $tbl_cliente
 * @property TblProyecto|null $tbl_proyecto
 *
 * @package App\Models
 */
class TblIncidenciaCliente extends Model
{
    use HasFactory;
	protected $table = 'tbl_incidencia_cliente';

	protected $casts = [
		'cliente_id' => 'int',
		'fecha_reporte' => 'datetime',
		'proyecto_id' => 'int'
	];

	protected $fillable = [
		'cliente_id',
		'tipo',
		'descripcion',
		'fecha_reporte',
		'estado',
		'proyecto_id'
	];

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
	}

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
