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
        Schema::table('carts_products_options', function (Blueprint $table) {
            $table->string('option_name')->after('cart_product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts_products_options', function (Blueprint $table) {
            $table->dropColumn('option_name');
        });
    }
};
