<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCartProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            // Asegurarse de que las columnas cart_id y product_id existen
            if (!Schema::hasColumn('cart_product', 'cart_id')) {
                $table->unsignedBigInteger('cart_id');
            }

            if (!Schema::hasColumn('cart_product', 'product_id')) {
                $table->unsignedBigInteger('product_id');
            }

            // Agregar claves foráneas con nombres únicos
            if (!Schema::hasColumn('cart_product', 'cart_id')) {
                $table->foreign('cart_id', 'fk_cartproduct_cart_id')
                      ->references('id')->on('carts')
                      ->onDelete('cascade');
            }

            if (!Schema::hasColumn('cart_product', 'product_id')) {
                $table->foreign('product_id', 'fk_cartproduct_product_id')
                      ->references('id')->on('products')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cart_product', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign('fk_cartproduct_cart_id');
            $table->dropForeign('fk_cartproduct_product_id');
        });
    }
}