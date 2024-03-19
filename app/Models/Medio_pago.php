<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * @OA\Schema(
 *     schema="MedioPago",
 *     title="MedioPago",
 *     description="Modelo de Medio de Pago",
 *     @OA\Property(
 *         property="id_medio_pago",
 *         type="integer",
 *         description="ID del medio de pago",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del medio de pago",
 *         example="Efectivo"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción del medio de pago",
 *         example="Pago en efectivo al momento de la entrega"
 *     )
 * )
 */

class Medio_pago extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'medio_pago';
    protected $primaryKey = 'id_m';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function forma_pago(): BelongsTo
{
    return $this->belongsTo(Forma_pago::class, 'id_forma_pago', 'id_forma_pago');
}
}
