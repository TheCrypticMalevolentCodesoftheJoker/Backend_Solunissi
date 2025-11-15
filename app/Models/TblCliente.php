<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblCliente
 * 
 * @property int $id
 * @property int $lead_id
 * @property string|null $ruc
 * @property string|null $razon_social
 * @property string|null $tipo_cliente
 * @property string|null $direccion
 * @property string|null $pais
 * @property string|null $departamento
 * @property string|null $provincia
 * @property string|null $distrito
 * @property string|null $web
 * @property string|null $sector
 * @property string|null $referencia
 * @property string|null $cargo_contacto
 * @property string|null $area_contacto
 * @property string|null $linkedin
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $estado
 * 
 * @property TblLead $tbl_lead
 * @property Collection|TblClienteIncidencium[] $tbl_cliente_incidencia
 * @property Collection|TblContrato[] $tbl_contratos
 *
 * @package App\Models
 */
class TblCliente extends Model
{
    use HasFactory;
	protected $table = 'tbl_cliente';
	public $timestamps = false;

	protected $casts = [
		'lead_id' => 'int'
	];

	protected $fillable = [
		'lead_id',
		'ruc',
		'razon_social',
		'tipo_cliente',
		'direccion',
		'pais',
		'departamento',
		'provincia',
		'distrito',
		'web',
		'sector',
		'referencia',
		'cargo_contacto',
		'area_contacto',
		'linkedin',
		'facebook',
		'twitter',
		'instagram',
		'estado'
	];

	public function tbl_lead()
	{
		return $this->belongsTo(TblLead::class, 'lead_id');
	}

	public function tbl_cliente_incidencia()
	{
		return $this->hasMany(TblClienteIncidencium::class, 'cliente_id');
	}

	public function tbl_contratos()
	{
		return $this->hasMany(TblContrato::class, 'cliente_id');
	}
}
