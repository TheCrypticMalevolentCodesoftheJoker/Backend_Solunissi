<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSoliMatDet
 * 
 * @property int $id
 * @property int $soli_mat_id
 * @property int $material_id
 * @property float|null $cantidad
 * @property string|null $estado
 * 
 * @property TblMaterial $tbl_material
 * @property TblSoliMat $tbl_soli_mat
 *
 * @package App\Models
 */
class TblSoliMatDet extends Model
{
    use HasFactory;
	protected $table = 'tbl_soli_mat_det';
	public $timestamps = false;

	protected $casts = [
		'soli_mat_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		'soli_mat_id',
		'material_id',
		'cantidad',
		'estado'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_soli_mat()
	{
		return $this->belongsTo(TblSoliMat::class, 'soli_mat_id');
	}
}
