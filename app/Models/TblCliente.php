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
 * Class TblCliente
 * 
 * @property int $id
 * @property string $razon_social
 * @property string $ruc
 * @property string $tipo_cliente
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string $correo
 * @property bool $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblContactoCliente[] $tbl_contacto_clientes
 * @property Collection|TblContrato[] $tbl_contratos
 * @property Collection|TblIncidenciaCliente[] $tbl_incidencia_clientes
 * @property Collection|TblLead[] $tbl_leads
 *
 * @package App\Models
 */
class TblCliente extends Model
{
    use HasFactory;
	protected $table = 'tbl_cliente';

	protected $casts = [
		'estado' => 'bool'
	];

	protected $fillable = [
		'razon_social',
		'ruc',
		'tipo_cliente',
		'direccion',
		'telefono',
		'correo',
		'estado'
	];

	public function tbl_contacto_clientes()
	{
		return $this->hasMany(TblContactoCliente::class, 'cliente_id');
	}

	public function tbl_contratos()
	{
		return $this->hasMany(TblContrato::class, 'cliente_id');
	}

	public function tbl_incidencia_clientes()
	{
		return $this->hasMany(TblIncidenciaCliente::class, 'cliente_id');
	}

	public function tbl_leads()
	{
		return $this->hasMany(TblLead::class, 'cliente_id');
	}
}
