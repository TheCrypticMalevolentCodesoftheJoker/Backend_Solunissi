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
 * Class TblCuentaContable
 * 
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string $tipo
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblDetalleTransaccionContable[] $tbl_detalle_transaccion_contables
 *
 * @package App\Models
 */
class TblCuentaContable extends Model
{
    use HasFactory;
	protected $table = 'tbl_cuenta_contable';

	protected $fillable = [
		'codigo',
		'nombre',
		'tipo',
		'descripcion'
	];

	public function tbl_detalle_transaccion_contables()
	{
		return $this->hasMany(TblDetalleTransaccionContable::class, 'cuenta_contable_id');
	}
}
