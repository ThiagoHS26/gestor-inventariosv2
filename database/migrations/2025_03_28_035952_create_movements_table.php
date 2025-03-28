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
    Schema::create('movements', function (Blueprint $table) {
        $table->id();
        $table->enum('type', ['ingreso', 'egreso']);
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relación con productos
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con usuarios
        $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Relación con almacén
        $table->integer('quantity');
        $table->date('date');
        $table->softDeletes();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
