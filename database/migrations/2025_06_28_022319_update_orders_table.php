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
        Schema::table('orders', function (Blueprint $table) {
            // Eliminamos columnas existentes
            $table->dropForeign('orders_producto_id_foreign');
            $table->dropColumn(['producto_id', 'opciones_personalizacion']);

            // Añadimos nuevas columnas, esoo
            $table->string('status')->default('pendiente');
            $table->boolean('pagado')->default(false);
            $table->string('metodo_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->text('opciones_personalizacion')->nullable();

            $table->dropColumn(['status', 'pagado', 'metodo_pago']);
        });
    }
};
