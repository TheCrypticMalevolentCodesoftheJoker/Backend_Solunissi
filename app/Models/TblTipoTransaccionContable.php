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
 * Class TblTipoTransaccionContable
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblTransaccionContable[] $tbl_transaccion_contables
 *
 * @package App\Models
 */
class TblTipoTransaccionContable extends Model
{
    use HasFactory;
	protected $table = 'tbl_tipo_transaccion_contable';

	protected $fillable = [
		'nombre',
		'descripcion'
	];

	public function tbl_transaccion_contables()
	{
		return $this->hasMany(TblTransaccionContable::class, 'tipo_transaccion_contable_id');
	}
}
