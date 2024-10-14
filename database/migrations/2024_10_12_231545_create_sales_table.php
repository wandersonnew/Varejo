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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')
              ->constrained('customers')
              ->onDelete('cascade');
            $table->dateTime('data_venda');
            $table->decimal('total_venda', 10, 2);
            $table->foreignId('cupom_desconto')->nullable()
                ->constrained('discounts')
                ->onDelete('set null');
            $table->decimal('total_final', 10, 2);
            $table->string('status')->default('em processamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
