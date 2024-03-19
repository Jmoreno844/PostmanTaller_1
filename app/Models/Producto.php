<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Producto",
 *     title="Producto",
 *     description="Modelo de Producto",
 *     @OA\Property(
 *         property="id_producto",
 *         type="integer",
 *         description="ID del producto",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del producto",
 *         example="Camiseta"
 *     ),
 *     @OA\Property(
 *         property="descripcion",
 *         type="string",
 *         description="Descripción del producto",
 *         example="Camiseta de algodón de manga corta"
 *     ),
 *     @OA\Property(
 *         property="precio",
 *         type="number",
 *         format="float",
 *         description="Precio del producto",
 *         example="29.99"
 *     ),
 *     @OA\Property(
 *         property="id_categoria",
 *         type="integer",
 *         description="ID de la categoría del producto",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="id_marca",
 *         type="integer",
 *         description="ID de la marca del producto",
 *         example="1"
 *     )
 * )
 */

class Producto extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function categoria(): BelongsTo
{
    return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
}
    public function marca(): BelongsTo
{
    return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
}
    public function productos_pedido(): BelongsTo
{
    return $this->belongsTo(productos_pedido::class, 'id_producto', 'id_producto');
}
}
