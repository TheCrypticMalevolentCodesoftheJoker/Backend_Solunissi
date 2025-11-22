<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblTrasladoDetalle
 * 
 * @property int $id
 * @property int $traslado_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblTraslado $tbl_traslado
 *
 * @package App\Models
 */
class TblTrasladoDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_traslado_detalle';
	public $timestamps = false;

	protected $casts = [
		'traslado_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'traslado_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_traslado()
	{
		return $this->belongsTo(TblTraslado::class, 'traslado_id');
	}
}
