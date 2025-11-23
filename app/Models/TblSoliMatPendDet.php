<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSoliMatPendDet
 * 
 * @property int $id
 * @property int $soli_mat_pend_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblSoliMatPend $tbl_soli_mat_pend
 *
 * @package App\Models
 */
class TblSoliMatPendDet extends Model
{
    use HasFactory;
	protected $table = 'tbl_soli_mat_pend_det';
	public $timestamps = false;

	protected $casts = [
		'soli_mat_pend_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'soli_mat_pend_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_soli_mat_pend()
	{
		return $this->belongsTo(TblSoliMatPend::class, 'soli_mat_pend_id');
	}
}
