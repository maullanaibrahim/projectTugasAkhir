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
        Schema::create('receiving_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_number')->unique();
            $table->date('receiving_date');
            $table->bigInteger('purchase_id');
            $table->string('recipient');
            $table->string('division_name');
            $table->string('invoice_number');
            $table->string('receiving_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiving_purchases');
    }
};
