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
        Schema::create('Producto', function (Blueprint $table) {
            $table->id("id_producto");
            $table->string("Nombre");
            $table->integer("Precio");
            $table->string("Descripcion");
            $table->unsignedBigInteger("id_categoria");
            $table->unsignedBigInteger("id_marca");
            $table->foreign("id_categoria")->references("id_categoria")->on("Categoria")->onDelete("cascade");
            $table->foreign("id_marca")->references("id_marca")->on("Marca")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Producto');
    }
};
