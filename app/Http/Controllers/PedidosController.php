<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
* @OA\Info(
*             title="Mi primera documentacion con swagger",
*             version="1.0",
*             description="Si"
* )
*
* @OA\Server(url= "http://127.0.0.1:8000")
*/
class PedidosController extends Controller
{




/**
     * Lista todos los pedidos.
     * @OA\Get (
     *     path="/api/pedidos",
     *     tags={"Pedidos"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id_pedido",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="fecha_creacion",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="id_proveedor",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="id_forma_pago",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="id_cliente",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                         @OA\Property(
     *                         property="id_estado_pedido",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function getAllPedidos(){

        $pedido = Pedidos::all();

        return response()->json(["Pedido",$pedido],200);

    }

    /**
 * Obtiene un pedido específico por su ID.
 * @OA\Get (
 *     path="/api/pedidos/{id}",
 *     tags={"Pedidos"},
 *     summary="Obtiene un pedido por su ID",
 *     description="Devuelve un pedido específico según el ID proporcionado.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del pedido",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="Pedidos",
 *                 type="object",
 *                 ref="#/components/schemas/Pedidos"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pedido no encontrado"
 *     )
 * )
 */
    public function getPedido($id){

        $pedido = Pedidos::findOrFail($id);

        return response()->json(["Pedido",$pedido],200);

    }

    /**
 * Crea un nuevo pedido.
 * @OA\Post(
 *     path="/api/pedidos",
 *     tags={"Pedidos"},
 *     summary="Crea un nuevo pedido",
 *     description="Crea un nuevo pedido con los datos proporcionados en el cuerpo de la solicitud.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Fecha_creacion", "id_proveedor", "id_forma_pago", "id_cliente", "id_estado_pedido"},
 *                 @OA\Property(property="Fecha_creacion", type="string", format="date", example="2023-03-18"),
 *                 @OA\Property(property="id_proveedor", type="integer", example=1),
 *                 @OA\Property(property="id_forma_pago", type="integer", example=1),
 *                 @OA\Property(property="id_cliente", type="integer", example=1),
 *                 @OA\Property(property="id_estado_pedido", type="integer", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pedido creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Pedido creado correctamente"),
 *             @OA\Property(property="pedido", ref="#/components/schemas/Pedidos"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la solicitud"
 *     )
 * )
 */
    public function newPedido(Request $request){

        $validation = $request->validate([
            "Fecha_creacion" => "date|max:255",
            "id_proveedor"  => "required|numeric|max:255",
            "id_forma_pago"  => "required|numeric|max:255",
            "id_cliente"  => "required|numeric|max:255",
            "id_estado_pedido"  => "required|numeric|max:255",

        ]);

       $pedido = new Pedidos([
            "Fecha_creacion" => $request->input("Fecha_creacion"),
            "id_proveedor" => $request->input("id_proveedor"),
            "id_forma_pago" => $request->input("id_forma_pago"),
            "id_cliente" => $request->input("id_cliente"),
            "id_estado_pedido" => $request->input("id_estado_pedido"),

        ]);
        $pedido->save();
        return response()->json(["message"=>"Pedido.","categoria"=>$pedido],200);
    }


    /**
 * Actualiza un pedido.
 * @OA\Put(
 *     path="/api/pedidos/{id}",
 *     tags={"Pedidos"},
 *     summary="Actualiza un pedido.",
 *     description="Actualiza un pedido.",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del pedido",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Fecha_creacion", "id_proveedor", "id_forma_pago", "id_cliente", "id_estado_pedido"},
 *                 @OA\Property(property="Fecha_creacion", type="string", format="date", example="2023-03-18"),
 *                 @OA\Property(property="id_proveedor", type="integer", example=1),
 *                 @OA\Property(property="id_forma_pago", type="integer", example=1),
 *                 @OA\Property(property="id_cliente", type="integer", example=1),
 *                 @OA\Property(property="id_estado_pedido", type="integer", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pedido creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Pedido creado correctamente"),
 *             @OA\Property(property="pedido", ref="#/components/schemas/Pedidos"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la solicitud"
 *     )
 * )
 */
    public function updatePedido(Request $request, $id){

        $validation = $request->validate([
            "Fecha_creacion" => "date|max:255",
            "id_proveedor"  => "required|numeric|max:255",
            "id_forma_pago"  => "required|numeric|max:255",
            "id_cliente"  => "required|numeric|max:255",
            "id_estado_pedido"  => "required|numeric|max:255",

        ]);

        $pedido = Pedidos::findOrFail($id)->update([
            "Fecha_creacion" => $request->input("Fecha_creacion"),
            "id_proveedor" => $request->input("id_proveedor"),
            "id_forma_pago" => $request->input("id_forma_pago"),
            "id_cliente" => $request->input("id_cliente"),
            "id_estado_pedido" => $request->input("id_estado_pedido"),

        ]);
        $pedido = Pedidos::findOrFail($id);
        return response()->json(["message"=>"Pedido actualizado con exito.","Pedido"=>$pedido],200);
    }

       /**
 * Borra un pedido.
 * @OA\Delete(
 *     path="/api/pedidos/{id}",
 *     tags={"Pedidos"},
 *     summary="Borra un pedido.",
 *     description="Borra un pedido.",
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del pedido",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pedido eliminado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Pedido eliminado correctamente"),
 *             @OA\Property(property="pedido", ref="#/components/schemas/Pedidos"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la solicitud"
 *     )
 * )
 */
    public function deletePedido($id){

        $pedido = Pedidos::findOrFail($id);
        $pedido->delete();

        return response()->json(["message"=>"Pedido eleminado.","Pedido"=>$pedido],200);

    }

    //1. Listar productos con su categoría y precio mayor a $1500:
    public function selects($id){


        switch ($id) {
            case 1:
                $select = DB::table("producto")->where("precio",">=",1500)
                    ->join("categoria" , "producto.id_categoria", "=" , "categoria.id_categoria")
                    ->select("producto.*","categoria.nombre as nombre_categoria")
                    ->get();
                break;
            case 2:
                $select = DB::table("pedidos")->where("pedidos.id_cliente","=",3)
                    ->join("cliente" , "pedidos.id_cliente", "=" , "cliente.id_cliente")
                    ->select("pedidos.*","cliente.nombre as nombre_cliente")
                    ->get();
                break;
            case 4:
                $select = DB::table("pedidos")->latest("fecha_creacion")->take(5)
                    ->join("productos_pedido", "pedidos.id_pedido", "=" , "productos_pedido.id_pedido")
                    ->join("producto", "producto.id_producto", "=" , "productos_pedido.id_producto")
                    ->join("cliente" , "pedidos.id_cliente", "=" , "cliente.id_cliente")
                    ->join("forma_pago" , "pedidos.id_forma_pago", "=" , "forma_pago.id_forma_pago")
                    ->join("proveedor" , "proveedor.id_proveedor", "=" , "pedidos.id_proveedor")
                    ->join("estado_pedido" , "estado_pedido.id_estado_pedido", "=" , "pedidos.id_estado_pedido")
                    ->select("pedidos.id_pedido as ID_pedido","pedidos.fecha_creacion",
                    "cliente.nombre as nombre_cliente","forma_pago.nombre as forma_pago",
                    "proveedor.nombre as nombre_proveedor","estado_pedido.nombre as estado_pedido",
                    "producto.nombre as nombre_producto","productos_pedido.cantidad as cantidad",
                    DB::raw('(SUM(producto.precio * productos_pedido.cantidad)) as valor_total')
                    )
                    ->groupBy(
                        'pedidos.id_pedido',
                        'pedidos.fecha_creacion',
                        'cliente.nombre',
                        'forma_pago.nombre',
                        'proveedor.nombre',
                        'estado_pedido.nombre',
                        'producto.nombre',
                        'productos_pedido.cantidad'

                    )->get();
                break;
            case 5:
                $select = DB::table('categoria')
                ->leftJoin('producto', 'categoria.id_categoria', '=', 'producto.id_categoria')
               ->select('categoria.*', DB::raw('COUNT(producto.id_producto) as cantidad_productos'))
               ->groupBy('categoria.id_categoria', 'categoria.Nombre', 'categoria.Descripcion')
               ->get();

            break;
        }



        return response()->json(["Select: "=>$select],200);



    }

}
