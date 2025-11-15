<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblAlmacen
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $ubicacion
 * @property bool $estado
 * 
 * @property Collection|TblAlmacenMaterial[] $tbl_almacen_materials
 * @property Collection|TblIncidenciaInventario[] $tbl_incidencia_inventarios
 * @property Collection|TblInventarioMovimiento[] $tbl_inventario_movimientos
 * @property Collection|TblProyecto[] $tbl_proyectos
 *
 * @package App\Models
 */
class TblAlmacen extends Model
{
    use HasFactory;
	protected $table = 'tbl_almacen';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'ubicacion',
		'estado'
	];

	public function tbl_almacen_materials()
	{
		return $this->hasMany(TblAlmacenMaterial::class, 'almacen_id');
	}

	public function tbl_incidencia_inventarios()
	{
		return $this->hasMany(TblIncidenciaInventario::class, 'almacen_id');
	}

	public function tbl_inventario_movimientos()
	{
		return $this->hasMany(TblInventarioMovimiento::class, 'almacen_origen_id');
	}

	public function tbl_proyectos()
	{
		return $this->hasMany(TblProyecto::class, 'almacen_id');
	}
}
