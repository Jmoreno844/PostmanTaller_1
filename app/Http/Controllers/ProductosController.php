<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
/**
 * Lista todos los productos.
 * @OA\Get (
 *     path="/api/productos",
 *     tags={"Productos"},
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(ref="#/components/schemas/Producto")
 *             )
 *         )
 *     )
 * )
 */

    public function getAllProducts(){

        $productos = Producto::all();

        return response()->json(["Productos",$productos],200);

    }
    /**
 * Obtiene producto por ID.
 * @OA\Get (
 *     path="/api/productos/{id}",
 *     tags={"Productos"},
 *      @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del producto",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(ref="#/components/schemas/Producto")
 *             )
 *         )
 *     )
 * )
 */
    public function getProduct($id_producto){

        $producto = Producto::findOrFail($id_producto);

        return response()->json(["Producto",$producto],200);

    }

       /**
 * Crea un nuevo producto.
 * @OA\Post (
 *     path="/api/productos",
 *     tags={"Productos"},
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Nombre", "Precio", "Descripcion", "id_categoria", "id_marca"},
 *                 @OA\Property(property="Nombre", type="string", example="Televisor"),
 *                 @OA\Property(property="Precio", type="integer", example=15000),
 *                 @OA\Property(property="Descripcion", type="string", example="Televisor de 50 pulgadas LG"),
 *                 @OA\Property(property="id_categoria", type="integer", example=5),
 *                 @OA\Property(property="id_marca", type="integer", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(ref="#/components/schemas/Producto")
 *             )
 *         )
 *     )
 * )
 */
    public function newProduct(Request $request){

        $validation = $request->validate([
            "Nombre" => "required|string|max:255",
            "Precio"  => "required|numeric",
            "Descripcion"  => "required|string|max:255",
        ]);

       $producto = new Producto([
            "Nombre" => $request->input("Nombre"),
            "Precio" => $request->input("Precio"),
            "Descripcion" => $request->input("Descripcion"),
            "id_categoria" => $request->input("id_categoria"),
            "id_marca" => $request->input("id_marca"),
        ]);
        $producto->save();
        return response()->json(["message"=>"Producto creado con exito.","user"=>$producto],200);
    }

           /**
 * Actualiza un  producto.
 * @OA\Put (
 *     path="/api/productos/{id}",
 *     tags={"Productos"},
 *  @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del producto",
 *         @OA\Schema(type="integer")
 *     ),
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Nombre", "Precio", "Descripcion", "id_categoria", "id_marca"},
 *                 @OA\Property(property="Nombre", type="string", example="Televisor"),
 *                 @OA\Property(property="Precio", type="integer", example=15000),
 *                 @OA\Property(property="Descripcion", type="string", example="Televisor de 50 pulgadas LG"),
 *                 @OA\Property(property="id_categoria", type="integer", example=5),
 *                 @OA\Property(property="id_marca", type="integer", example=1),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(ref="#/components/schemas/Producto")
 *             )
 *         )
 *     )
 * )
 */
    public function updateProduct(Request $request, $id){

        $validation = $request->validate([
            "Nombre" => "required|string|max:255",
            "Precio"  => "required|numeric",
            "Descripcion"  => "required|string|max:255",
        ]);

        $producto = Producto::findOrFail($id)->update([
            "Nombre" => $request->input("Nombre"),
            "Precio" => $request->input("Precio"),
            "Descripcion" => $request->input("Descripcion"),
            "id_categoria" => $request->input("id_categoria"),
            "id_marca" => $request->input("id_marca"),
        ]);
        $producto = Producto::findOrFail($id);
        return response()->json(["message"=>"Producto actualizado con exito.","Producto"=>$producto],200);
    }


               /**
 * Borra un producto.
 * @OA\Delete (
 *     path="/api/productos/{id}",
 *     tags={"Productos"},
 *  @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID del producto",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(ref="#/components/schemas/Producto")
 *             )
 *         )
 *     )
 * )
 */
    public function deleteProduct($id){

        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(["message"=>"Producto eleminado.","Producto"=>$producto],200);

    }
}
