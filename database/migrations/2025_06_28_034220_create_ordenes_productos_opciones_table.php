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
        Schema::create('orders_products_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_product_id')->constrained('orders_products')->onDelete('cascade');
            $table->text('option_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_productos_opciones');
    }
};
