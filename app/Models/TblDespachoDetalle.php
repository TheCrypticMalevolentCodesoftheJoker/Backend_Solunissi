<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDespachoDetalle
 * 
 * @property int $id
 * @property int $despacho_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblDespacho $tbl_despacho
 * @property TblMaterial $tbl_material
 *
 * @package App\Models
 */
class TblDespachoDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_despacho_detalle';
	public $timestamps = false;

	protected $casts = [
		'despacho_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'despacho_id',
		'material_id',
		'cantidad'
	];

	public function tbl_despacho()
	{
		return $this->belongsTo(TblDespacho::class, 'despacho_id');
	}

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}
}
