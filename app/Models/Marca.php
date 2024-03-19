<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @OA\Schema(
 *     schema="Marca",
 *     title="Marcar",
 *     description="Modelo de tabla Marca",
 *     @OA\Property(
 *         property="id_marca",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         example="Marca Alpha"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         example="Una marca líder en innovación y calidad"
 *     ),
 * )
 */
class Marca extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function producto(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_marca', 'id_marca');
    }
}
