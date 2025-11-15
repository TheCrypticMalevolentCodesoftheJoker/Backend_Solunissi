<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblLeadComunicacion
 * 
 * @property int $id
 * @property int $vendedor_id
 * @property int $lead_id
 * @property Carbon $fecha
 * @property string $tipo
 * @property string|null $asunto
 * @property string|null $detalle
 * 
 * @property TblLead $tbl_lead
 * @property TblEmpleado $tbl_empleado
 *
 * @package App\Models
 */
class TblLeadComunicacion extends Model
{
    use HasFactory;
	protected $table = 'tbl_lead_comunicacion';
	public $timestamps = false;

	protected $casts = [
		'vendedor_id' => 'int',
		'lead_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'vendedor_id',
		'lead_id',
		'fecha',
		'tipo',
		'asunto',
		'detalle'
	];

	public function tbl_lead()
	{
		return $this->belongsTo(TblLead::class, 'lead_id');
	}

	public function tbl_empleado()
	{
		return $this->belongsTo(TblEmpleado::class, 'vendedor_id');
	}
}
