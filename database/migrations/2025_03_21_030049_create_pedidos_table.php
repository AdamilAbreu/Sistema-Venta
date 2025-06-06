<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido');
            $table->string('estado');
            $table->decimal('total',10,2);
            $table->string('direcion_envio');
            $table->string('metodo_pago');
            $table->integer('cantidad');
            $table->unsignedBigInteger('articulo_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
