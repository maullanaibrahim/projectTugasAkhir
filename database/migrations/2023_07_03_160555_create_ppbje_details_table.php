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
        Schema::create('ppbje_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ppbje_id');
            $table->bigInteger('item_id');
            $table->bigInteger('supplier_id');
            $table->decimal('quantity', 12, 1);
            $table->decimal('price', 12, 2);
            $table->decimal('price_total', 12, 2);
            $table->string('purchase_number')->nullable();
            $table->string('receiving_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppbje_details');
    }
};
