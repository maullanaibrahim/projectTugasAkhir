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
        Schema::create('ppbjes', function (Blueprint $table) {
            $table->id();
            $table->string('no_ppbje')->unique();
            $table->string('pembuat');
            $table->string('divisi_pembuat');
            $table->bigInteger('cost_id');
            $table->string('region');
            $table->bigInteger('employee_id');
            $table->string('employee_position');
            $table->string('employee_division');
            $table->string('jenis_ppbje');
            $table->date('tgl_kebutuhan');
            $table->string('alasan');
            $table->double('total_biaya');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppbjes');
    }
};
