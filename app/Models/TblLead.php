<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblLead
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $apellido
 * @property string|null $empresa
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $fuente
 * @property string|null $estado
 * 
 * @property Collection|TblCliente[] $tbl_clientes
 * @property Collection|TblLeadComunicacion[] $tbl_lead_comunicacions
 *
 * @package App\Models
 */
class TblLead extends Model
{
    use HasFactory;
	protected $table = 'tbl_lead';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'apellido',
		'empresa',
		'correo',
		'telefono',
		'fuente',
		'estado'
	];

	public function tbl_clientes()
	{
		return $this->hasMany(TblCliente::class, 'lead_id');
	}

	public function tbl_lead_comunicacions()
	{
		return $this->hasMany(TblLeadComunicacion::class, 'lead_id');
	}
}
