<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @OA\Schema(
 *     schema="Proveedor",
 *     title="Proveedor",
 *     description="Modelo de Proveedor",
 *     @OA\Property(
 *         property="id_proveedor",
 *         type="integer",
 *         description="ID del proveedor",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del proveedor",
 *         example="Proveedor A"
 *     ),
 *     @OA\Property(
 *         property="direccion",
 *         type="string",
 *         description="Dirección del proveedor",
 *         example="Calle 123, Ciudad, País"
 *     ),
 *     @OA\Property(
 *         property="telefono",
 *         type="string",
 *         description="Teléfono del proveedor",
 *         example="+1234567890"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Correo electrónico del proveedor",
 *         example="proveedor@example.com"
 *     )
 * )
 */


class Proveedor extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedidos::class, 'id_proveedor', 'id_proveedor');
    }
}
