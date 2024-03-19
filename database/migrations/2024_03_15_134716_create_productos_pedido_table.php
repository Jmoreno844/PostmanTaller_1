<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_pedido', function (Blueprint $table) {
            $table->id("id_productos_pedido");
            $table->unsignedBigInteger("id_producto");
            $table->unsignedBigInteger("id_pedido");
            $table->foreign("id_producto")->references("id_producto")->on("Producto")->onDelete("cascade");
            $table->foreign("id_pedido")->references("id_pedido")->on("Pedidos")->onDelete("cascade");
            $table->integer("cantidad");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_pedido');
    }
};
