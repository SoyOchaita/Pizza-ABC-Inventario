<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToCartProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            // Asegurarse de que la columna quantity existe
            if (!Schema::hasColumn('cart_product', 'quantity')) {
                $table->integer('quantity')->default(1); // Agregar la columna quantity
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            // Eliminar la columna quantity
            if (Schema::hasColumn('cart_product', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });
    }
}
