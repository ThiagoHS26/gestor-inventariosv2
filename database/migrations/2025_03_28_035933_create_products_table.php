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
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relación con categoría
        $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('cascade'); // Relación con almacén
        $table->integer('quantity')->default(0);
        $table->integer('min_stock')->nullable();
        $table->integer('max_stock')->nullable();
        $table->decimal('price', 10, 2);
        $table->softDeletes();
        $table->timestamps();
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
