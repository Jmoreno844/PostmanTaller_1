<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @OA\Schema(
 *     schema="Cliente",
 *     title="Cliente",
 *     description="Modelo de tabla Cliente",
 *     @OA\Property(
 *         property="id_cliente",
 *         type="integer",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         example="Juan Pérez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         example="juan@example.com"
 *     ),
 *     @OA\Property(
 *         property="telefono",
 *         type="string",
 *         example="123456789"
 *     ),
 * )
 */
class Cliente extends Model
{
    use HasFactory;

    /*
    @var string
     */
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedidos::class, 'id_cliente', 'id_cliente');
    }
}
