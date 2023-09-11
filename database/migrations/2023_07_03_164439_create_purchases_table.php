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
            $table->bigInteger('user_id');
            $table->bigInteger('supplier_id');
            $table->decimal('purchase_total', 15, 2);
            $table->bigInteger('ppbje_id');
            $table->bigInteger('cost_id');
            $table->string('shipping_address');
            $table->string('shipping_date');
            $table->string('receiver_pic');
            $table->string('approved');
            $table->string('purchase_status')->nullable();
            $table->string('purchase_note')->nullable();
            $table->bigInteger('receiving_id')->nullable();
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
