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
            $table->string('purchase_expired');
            $table->string('purchase_maker');
            $table->bigInteger('supplier_id');
            $table->double('purchase_total');
            $table->bigInteger('ppbje_id');
            $table->bigInteger('cost_id');
            $table->string('shipping_address');
            $table->string('shipping_date');
            $table->string('receiver_pic');
            $table->string('approved');
            $table->string('purchase_status')->nullable();
            $table->string('purchase_note')->nullable();
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
