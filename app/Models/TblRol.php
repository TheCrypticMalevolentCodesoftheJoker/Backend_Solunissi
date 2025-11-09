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
 * Class TblRol
 * 
 * @property int $RolID
 * @property string $NombreRol
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblUsuario[] $tbl_usuarios
 *
 * @package App\Models
 */
class TblRol extends Model
{
    use HasFactory;
	protected $table = 'tbl_rol';
	protected $primaryKey = 'RolID';

	protected $fillable = [
		'NombreRol'
	];

	public function tbl_usuarios()
	{
		return $this->hasMany(TblUsuario::class, 'RolID');
	}
}
