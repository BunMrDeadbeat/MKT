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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID de la orden
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID del usuario
            $table->foreignId('producto_id')->constrained('products')->onDelete('cascade'); // ID del producto
            $table->json('opciones_personalizacion'); // Campo JSON para opciones de personalización
            $table->decimal('monto', 10, 2)->nullable(); // Monto de la orden, opcional
            $table->timestamps(); // Fechas de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
