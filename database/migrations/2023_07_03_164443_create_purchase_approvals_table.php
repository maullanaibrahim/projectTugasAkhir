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
        Schema::create('purchase_approvals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_id');
            $table->string('status1');
            $table->string('tgl1');
            $table->string('chief');
            $table->string('catatan1');
            $table->string('status2');
            $table->string('tgl2');
            $table->string('manager');
            $table->string('catatan2');
            $table->string('status3');
            $table->string('tgl3');
            $table->string('direktur');
            $table->string('catatan3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_approvals');
    }
};
