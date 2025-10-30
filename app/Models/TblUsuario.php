<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TblUsuario
 * 
 * @property int $UsuarioID
 * @property string $Nombre
 * @property string $Apellidos
 * @property string|null $Telefono
 * @property string $Email
 * @property string $Contrasena
 * @property bool $Estado
 * @property int $RolID
 * @property Carbon|null $UltimoLogin
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblRol $tbl_rol
 *
 * @package App\Models
 */
class TblUsuario extends Model
{
	use HasFactory;
	protected $table = 'tbl_usuario';
	protected $primaryKey = 'UsuarioID';

	protected $casts = [
		'Estado' => 'bool',
		'RolID' => 'int',
		'UltimoLogin' => 'datetime'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'Nombre',
		'Apellidos',
		'Telefono',
		'Email',
		'Contrasena',
		'Estado',
		'RolID',
		'UltimoLogin',
		'remember_token'
	];

	public function tbl_rol()
	{
		return $this->belongsTo(TblRol::class, 'RolID');
	}
}
