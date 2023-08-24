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
            $table->string('ppbje_number')->unique();
            $table->string('maker');
            $table->string('maker_division');
            $table->bigInteger('cost_id');
            $table->string('region');
            $table->string('applicant_nik');
            $table->string('applicant_name');
            $table->string('applicant_position');
            $table->string('applicant_division');
            $table->string('ppbje_type');
            $table->date('date_of_need');
            $table->string('reason');
            $table->decimal('cost_total', 15, 2);
            $table->string('approved');
            $table->string('ppbje_status');
            $table->string('ppbje_note')->nullable();
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
