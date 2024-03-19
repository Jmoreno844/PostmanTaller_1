<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/users",[UserController::class,"getAllUsers"])->name("users.getAllUser");
Route::post("/users",[UserController::class,"createUser"])->name("users.CreateUsers");
Route::get("/users/{id}",[UserController::class,"getUser"])->name("users.getUser");
Route::put("/users/{id}",[UserController::class,"updateUser"])->name("users.updateUser");
Route::delete("/users/{id}",[UserController::class,"deleteUser"])->name("users.deleteUser");


Route::get("/productos",[ProductosController::class,"getAllProducts"])->name("productos.getAllProducts");
Route::get("/productos/{id}",[ProductosController::class, "getProduct"])->name("productos.newProduct");
Route::post("/productos",[ProductosController::class, "newProduct"])->name("productos.newProduct");
Route::put("/productos/{id}",[ProductosController::class, "updateProduct"])->name("productos.newProduct");
Route::delete("/productos/{id}",[ProductosController::class, "deleteProduct"])->name("productos.newProduct");

Route::get("/categorias",[CategoriasController::class,"getAllCategories"])->name("categorias.getAllCategories");
Route::get("/categorias/{id}",[CategoriasController::class, "getCategory"])->name("categorias.getCategory");
Route::post("/categorias",[CategoriasController::class, "newCategory"])->name("categorias.newCategory");
Route::put("/categorias/{id}",[CategoriasController::class, "updateCategory"])->name("categorias.updateCategory");
Route::delete("/categorias/{id}",[CategoriasController::class, "deleteCategory"])->name("categorias.deleteCategory");

Route::get("/pedidos",[PedidosController::class,"getAllPedidos"])->name("pedidos.getAllPedidos");
Route::get("/pedidos/{id}",[PedidosController::class, "getPedido"])->name("pedidos.getPedido");
Route::post("/pedidos",[PedidosController::class, "newPedido"])->name("pedidos.newPedido");
Route::put("/pedidos/{id}",[PedidosController::class, "updatePedido"])->name("pedidos.updatePedido");
Route::delete("/pedidos/{id}",[PedidosController::class, "deletePedido"])->name("pedidos.deletePedido");
Route::get("/selects/{id}",[PedidosController::class, "selects"]);
