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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('cost_name');
            $table->string('region');
            $table->string('company_name');
            $table->timestamps();
        });

        DB::table('costs')->insert([
            ['cost_name' => 'Procurement', 'region' => 'Griya Center', 'company_name' => 'PT. Griya Pratama', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
