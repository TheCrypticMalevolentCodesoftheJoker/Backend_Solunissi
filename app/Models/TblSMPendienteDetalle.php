<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblSMPendienteDetalle
 * 
 * @property int $id
 * @property int $s_m_pendiente_id
 * @property int $material_id
 * @property float $cantidad
 * 
 * @property TblMaterial $tbl_material
 * @property TblSMPendiente $tbl_s_m_pendiente
 *
 * @package App\Models
 */
class TblSMPendienteDetalle extends Model
{
    use HasFactory;
	protected $table = 'tbl_s_m_pendiente_detalle';
	public $timestamps = false;

	protected $casts = [
		's_m_pendiente_id' => 'int',
		'material_id' => 'int',
		'cantidad' => 'float'
	];

	protected $fillable = [
		's_m_pendiente_id',
		'material_id',
		'cantidad'
	];

	public function tbl_material()
	{
		return $this->belongsTo(TblMaterial::class, 'material_id');
	}

	public function tbl_s_m_pendiente()
	{
		return $this->belongsTo(TblSMPendiente::class, 's_m_pendiente_id');
	}
}
