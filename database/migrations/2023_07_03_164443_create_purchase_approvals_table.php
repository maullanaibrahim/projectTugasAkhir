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
            $table->string('date1')->nullable();
            $table->string('chief');
            $table->string('note1')->nullable();
            $table->string('status2');
            $table->string('date2')->nullable();
            $table->string('manager');
            $table->string('note2')->nullable();
            $table->string('status3');
            $table->string('date3')->nullable();
            $table->string('direktur');
            $table->string('note3')->nullable();
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
