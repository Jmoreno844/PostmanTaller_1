<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Categoria",
 *     title="Categoria",
 *     description="Modelo de tabla Categoria",
 *     @OA\Property(
 *         property="id_categoria",
 *         type="integer",
 *         example="5"
 *     ),
 *     @OA\Property(
 *         property="Nombre",
 *         type="string",
 *         example="Marca Gamma alta"
 *     ),
*     @OA\Property(
 *         property="Descripcion",
 *         type="string",
 *         example="La marca mascara de todas."
 *     ),
 * )
 */

class Categoria extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function producto(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }


}
