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
        Schema::create('sales_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venda_id')
              ->constrained('sales')
              ->onDelete('cascade');
            $table->foreignId('produto_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_itens');
    }
};
