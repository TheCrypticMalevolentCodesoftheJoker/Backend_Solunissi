<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblPresupuestoProyecto
 * 
 * @property int $id
 * @property int $proyecto_id
 * @property string $categoria
 * @property float $monto_asignado
 * @property float $monto_ejecutado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProyecto $tbl_proyecto
 *
 * @package App\Models
 */
class TblPresupuestoProyecto extends Model
{
    use HasFactory;
	protected $table = 'tbl_presupuesto_proyecto';

	protected $casts = [
		'proyecto_id' => 'int',
		'monto_asignado' => 'float',
		'monto_ejecutado' => 'float'
	];

	protected $fillable = [
		'proyecto_id',
		'categoria',
		'monto_asignado',
		'monto_ejecutado'
	];

	public function tbl_proyecto()
	{
		return $this->belongsTo(TblProyecto::class, 'proyecto_id');
	}
}
