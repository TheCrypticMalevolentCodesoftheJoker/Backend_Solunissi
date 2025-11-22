<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblProveedor
 * 
 * @property int $id
 * @property string $razon_social
 * @property string|null $nombre_comercial
 * @property string $ruc
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $correo
 * @property string|null $pagina_web
 * @property string|null $contacto_nombre
 * @property string|null $contacto_telefono
 * @property string|null $contacto_correo
 * @property string $estado
 * 
 * @property Collection|TblCotizacion[] $tbl_cotizacions
 *
 * @package App\Models
 */
class TblProveedor extends Model
{
    use HasFactory;
	protected $table = 'tbl_proveedor';
	public $timestamps = false;

	protected $fillable = [
		'razon_social',
		'nombre_comercial',
		'ruc',
		'direccion',
		'telefono',
		'correo',
		'pagina_web',
		'contacto_nombre',
		'contacto_telefono',
		'contacto_correo',
		'estado'
	];

	public function tbl_cotizacions()
	{
		return $this->hasMany(TblCotizacion::class, 'proveedor_id');
	}
}
