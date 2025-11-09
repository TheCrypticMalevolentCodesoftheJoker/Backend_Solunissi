<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblCargo
 * 
 * @property int $id
 * @property string $nombre
 * @property float $salario_base
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblEmpleado[] $tbl_empleados
 *
 * @package App\Models
 */
class TblCargo extends Model
{
    use HasFactory;
	protected $table = 'tbl_cargo';

	protected $casts = [
		'salario_base' => 'float'
	];

	protected $fillable = [
		'nombre',
		'salario_base'
	];

	public function tbl_empleados()
	{
		return $this->hasMany(TblEmpleado::class, 'cargo_id');
	}
}
