<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
/**
 * @OA\Schema(
 *     schema="EstadoPedido",
 *     title="EstadoPedido",
 *     description="Modelo de Estado de Pedido",
 *     @OA\Property(
 *         property="id_estado_pedido",
 *         type="integer",
 *         description="ID del estado del pedido",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del estado del pedido",
 *         example="En proceso"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción del estado del pedido",
 *         example="El pedido se encuentra en proceso de preparación"
 *     )
 * )
 */

class Estado_pedido extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'estado_pedido';
    protected $primaryKey = 'id_estados_pedido';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function pedidos(): HasOne
    {
        return $this->hasOne(Pedidos::class, 'id_estado_pedido', 'id_estado_pedido');
    }
}
