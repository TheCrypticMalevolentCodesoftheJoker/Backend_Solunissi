<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblContactoCliente
 * 
 * @property int $id
 * @property int $cliente_id
 * @property string $nombre
 * @property string|null $cargo
 * @property string|null $telefono
 * @property string|null $correo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblCliente $tbl_cliente
 *
 * @package App\Models
 */
class TblContactoCliente extends Model
{
    use HasFactory;
	protected $table = 'tbl_contacto_cliente';

	protected $casts = [
		'cliente_id' => 'int'
	];

	protected $fillable = [
		'cliente_id',
		'nombre',
		'cargo',
		'telefono',
		'correo'
	];

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
	}
}
