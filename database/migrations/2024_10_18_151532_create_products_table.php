<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Llave primaria
        $table->string('name'); // Nombre del producto
        $table->text('description')->nullable(); // Descripción del producto
        $table->decimal('price', 8, 2); // Precio del producto
        $table->unsignedBigInteger('category_id'); // Llave foránea de categoría
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        $table->timestamps(); // timestamps de creación y actualización
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
