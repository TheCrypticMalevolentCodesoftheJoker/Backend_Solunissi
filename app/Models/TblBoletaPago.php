<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblBoletaPago
 * 
 * @property int $id
 * @property int $nomina_id
 * @property string $numero
 * @property Carbon $fecha_emision
 * @property string|null $archivo_pdf
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblNomina $tbl_nomina
 *
 * @package App\Models
 */
class TblBoletaPago extends Model
{
    use HasFactory;
	protected $table = 'tbl_boleta_pago';

	protected $casts = [
		'nomina_id' => 'int',
		'fecha_emision' => 'datetime'
	];

	protected $fillable = [
		'nomina_id',
		'numero',
		'fecha_emision',
		'archivo_pdf'
	];

	public function tbl_nomina()
	{
		return $this->belongsTo(TblNomina::class, 'nomina_id');
	}
}
