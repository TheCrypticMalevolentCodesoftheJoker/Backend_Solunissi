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
 * Class TblProveedor
 * 
 * @property int $id
 * @property string $razon_social
 * @property string $ruc
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string $correo
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 *
 * @package App\Models
 */
class TblProveedor extends Model
{
    use HasFactory;
	protected $table = 'tbl_proveedor';

	protected $casts = [
		'estado' => 'bool'
	];

	protected $fillable = [
		'razon_social',
		'ruc',
		'direccion',
		'telefono',
		'correo',
		'estado'
	];

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'proveedor_id');
	}
}
