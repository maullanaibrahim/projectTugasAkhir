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
            $table->string('no_receiving')->unique();
            $table->date('tgl_receiving');
            $table->bigInteger('purchase_id');
            $table->string('penerima');
            $table->string('divisi');
            $table->string('no_sj');
            $table->string('keterangan');
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
