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
 * Class TblRutaTransporte
 * 
 * @property int $id
 * @property string $origen
 * @property string $destino
 * @property float $distancia_km
 * @property Carbon $tiempo_estimado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblViaje[] $tbl_viajes
 *
 * @package App\Models
 */
class TblRutaTransporte extends Model
{
    use HasFactory;
	protected $table = 'tbl_ruta_transporte';

	protected $casts = [
		'distancia_km' => 'float',
		'tiempo_estimado' => 'datetime'
	];

	protected $fillable = [
		'origen',
		'destino',
		'distancia_km',
		'tiempo_estimado'
	];

	public function tbl_viajes()
	{
		return $this->hasMany(TblViaje::class, 'ruta_id');
	}
}
