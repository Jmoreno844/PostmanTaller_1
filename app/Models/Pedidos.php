<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Pedidos",
 *     title="Pedidos",
 *     description="Modelo de datos para Pedidos.",
 *     @OA\Property(
 *         property="id_pedido",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="fecha_creacion",
 *         type="string",
 *         format="date-time",
 *         example="2023-02-23T00:09:16.000000Z"
 *     ),
 *     @OA\Property(
 *         property="id_proveedor",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_forma_pago",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_cliente",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_estado_pedido",
 *         type="integer",
 *         example="1"
 *     ),
 * )
 */

class Pedidos extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';
    public $timestamps = false;


    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function productos_pedido(): BelongsTo
{
    return $this->belongsTo(productos_pedido::class, 'id_pedido', 'id_pedido');
}

    public function proveedor(): BelongsTo
{
    return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
}

    public function estado_pedido(): BelongsTo
{
    return $this->belongsTo(Estado_pedido::class, 'id_estado_pedido', 'id_estado_pedido');
}
    public function forma_pago(): BelongsTo
{
    return $this->belongsTo(Forma_pago::class, 'id_forma_pago', 'id_forma_pago');
}


}
