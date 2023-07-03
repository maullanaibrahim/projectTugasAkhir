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
            $table->string('no_purchase')->unique();
            $table->date('tgl_purchase');
            $table->date('exp_purchase');
            $table->string('pembuat');
            $table->string('nama_supplier');
            $table->double('total');
            $table->bigInteger('ppbje_id');
            $table->bigInteger('cost_id');
            $table->string('keterangan');
            $table->string('no_receiving');
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
