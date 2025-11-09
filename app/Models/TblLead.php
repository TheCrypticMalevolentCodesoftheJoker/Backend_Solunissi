<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblLead
 * 
 * @property int $id
 * @property int $cliente_id
 * @property int|null $asignado_usuario_id
 * @property string|null $fuente
 * @property string $estado
 * @property string|null $notas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblUsuario|null $tbl_usuario
 * @property TblCliente $tbl_cliente
 *
 * @package App\Models
 */
class TblLead extends Model
{
    use HasFactory;
	protected $table = 'tbl_lead';

	protected $casts = [
		'cliente_id' => 'int',
		'asignado_usuario_id' => 'int'
	];

	protected $fillable = [
		'cliente_id',
		'asignado_usuario_id',
		'fuente',
		'estado',
		'notas'
	];

	public function tbl_usuario()
	{
		return $this->belongsTo(TblUsuario::class, 'asignado_usuario_id');
	}

	public function tbl_cliente()
	{
		return $this->belongsTo(TblCliente::class, 'cliente_id');
	}
}
