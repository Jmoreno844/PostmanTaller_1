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
        Schema::create('Medio_pago', function (Blueprint $table) {
            $table->id("id_medio_pago");
            $table->unsignedBigInteger("id_forma_pago");
            $table->foreign("id_forma_pago")->references("id_forma_pago")->on("Forma_pago")->onDelete('cascade');
            $table->string("Nombre");
            $table->string("Descripcion");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Medio_pago');
    }
};
