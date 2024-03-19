<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    /**
     * Lista todas los categorias.
     * @OA\Get (
     *     path="/api/categorias",
     *     tags={"Categorias"},
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
     *                         property="id_categoria",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="nombre",
     *                         type="string",
     *                         example="electronicos"
     *                     ),
     *                     @OA\Property(
     *                         property="descripcion",
     *                         type="string",
     *                         example="Todo tipo de electronicos"
     *
     *                     ),
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getAllCategories(){

        $categoria = Categoria::all();

        return response()->json(["Categoria",$categoria],200);

    }

     /**
 * Obtiene una categoria especifica por su ID.
 * @OA\Get (
 *     path="/api/categorias/{id}",
 *     tags={"Categorias"},
 *     summary="Obtiene una categoria por su ID",
 *     description="Devuelve una categoria específico según el ID proporcionado.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la categoria",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="Categoria",
 *                 type="object",
 *                 ref="#/components/schemas/Categoria"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pedido no encontrado"
 *     )
 * )
 */
    public function getCategory($id){

        $categoria = Categoria::findOrFail($id);

        return response()->json(["Categoria",$categoria],200);

    }

      /**
 * Crea una nueva categoria.
 * @OA\Post(
 *     path="/api/categorias",
 *     tags={"Categorias"},
 *     summary="Crea una nueva categoria",
 *     description="Crea una nueva categoria con los datos proporcionados en el cuerpo de la solicitud.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Nombre", "Descripcion"},
 *                 @OA\Property(property="Nombre", type="string", example="Ropa"),
 *                 @OA\Property(property="Descripcion", type="string", example="Ropa y accesorios"),
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
    public function newCategory(Request $request){

        $validation = $request->validate([
            "Nombre" => "required|string|max:255",
            "Descripcion"  => "required|string|max:255",
        ]);

       $categoria = new Categoria([
            "Nombre" => $request->input("Nombre"),
            "Descripcion" => $request->input("Descripcion"),
        ]);
        $categoria->save();
        return response()->json(["message"=>"Categoria creada con exito.","categoria"=>$categoria],200);
    }


      /**
 * Actualiza una nueva categoria.
 * @OA\Put(
 *     path="/api/categorias/{id}",
 *     tags={"Categorias"},
 *     summary="Actualiza una nueva categoria",
 *     description="Actualiza una nueva categoria con los datos proporcionados en el cuerpo de la solicitud.",
 *          @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la categoria",
 *         @OA\Schema(type="integer")
 *     ),
 *          @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"Nombre", "Descripcion"},
 *                 @OA\Property(property="Nombre", type="string", example="Ropa"),
 *                 @OA\Property(property="Descripcion", type="string", example="Ropa y accesorios"),
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
    public function updateCategory(Request $request, $id){

        $validation = $request->validate([
            "Nombre" => "required|string|max:255",
            "Descripcion"  => "required|string|max:255",
        ]);

        $categoria = Categoria::findOrFail($id)->update([
            "Nombre" => $request->input("Nombre"),
            "Descripcion" => $request->input("Descripcion"),
        ]);
        $categoria = Categoria::findOrFail($id);
        return response()->json(["message"=>"Categoria actualizada con exito.","Categoria"=>$categoria],200);
    }

        /**
 * Borra una  categoria.
 * @OA\Delete(
 *     path="/api/categorias/{id}",
 *     tags={"Categorias"},
 *     summary="Borra una  categoria",
 *     description="Borra una  categoria con los datos proporcionados en el cuerpo de la solicitud.",
 *          @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la categoria",
 *         @OA\Schema(type="integer")
 *     ),
 *
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

    public function deleteCategory($id){

        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(["message"=>"Categoria eleminada.","Categoria"=>$categoria],200);

    }
}
