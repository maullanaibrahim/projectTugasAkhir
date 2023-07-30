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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number')->unique();
            $table->date('purchase_date');
            $table->date('purchase_expired');
            $table->string('purchase_maker');
            $table->string('supplier_name');
            $table->double('purchase_total');
            $table->bigInteger('ppbje_id');
            $table->bigInteger('cost_id');
            $table->string('approved');
            $table->string('purchase_status')->nullable();
            $table->string('purchase_note')->nullable();
            $table->string('receiving_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
