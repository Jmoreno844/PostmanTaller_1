<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="ProductoPedido",
 *     title="ProductoPedido",
 *     description="Modelo de Producto-Pedido",
 *     @OA\Property(
 *         property="id_producto_pedido",
 *         type="integer",
 *         description="ID del producto-pedido",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_pedido",
 *         type="integer",
 *         description="ID del pedido asociado al producto",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_producto",
 *         type="integer",
 *         description="ID del producto asociado al pedido",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="cantidad",
 *         type="integer",
 *         description="Cantidad del producto en el pedido",
 *         example="2"
 *     )
 * )
 */

class productos_pedido extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'productos_pedido';
    protected $primaryKey = 'id_productos_pedido';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function producto(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_producto', 'id_producto');
    }
    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedidos::class, 'id_pedido', 'id_pedido');
    }
}
