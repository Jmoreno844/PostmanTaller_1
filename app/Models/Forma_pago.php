<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @OA\Schema(
 *     schema="FormaPago",
 *     title="FormaPago",
 *     description="Modelo de Forma de Pago",
 *     @OA\Property(
 *         property="id_forma_pago",
 *         type="integer",
 *         description="ID de la forma de pago",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre de la forma de pago",
 *         example="Tarjeta de crédito"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción de la forma de pago",
 *         example="Pago mediante tarjeta de crédito"
 *     )
 * )
 */

class Forma_pago extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'forma_pago';
    protected $primaryKey = 'id_forma_pago';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedidos::class, 'id_forma_pago', 'id_forma_pago');
    }

    public function medio_pago(): HasMany
    {
        return $this->hasMany(Medio_pago::class, 'id_forma_pago', 'id_forma_pago');
    }
}
