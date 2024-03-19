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
        Schema::create('Pedidos', function (Blueprint $table) {
            $table->id("id_pedido");
            $table->timestamp("Fecha_creacion");
            $table->unsignedBigInteger("id_proveedor");
            $table->unsignedBigInteger("id_forma_pago");
            $table->unsignedBigInteger("id_cliente");
            $table->unsignedBigInteger("id_estado_pedido");
            $table->foreign("id_proveedor")->references("id_proveedor")->on("Proveedor")->onDelete("cascade");
            $table->foreign("id_forma_pago")->references("id_forma_pago")->on("Forma_pago")->onDelete("cascade");
            $table->foreign("id_cliente")->references("id_cliente")->on("Cliente")->onDelete("cascade");
            $table->foreign("id_estado_pedido")->references("id_estado_pedido")->on("Estado_pedido")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pedidos');
    }
};
