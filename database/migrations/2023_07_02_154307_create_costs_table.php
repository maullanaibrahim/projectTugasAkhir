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
            ['cost_name' => 'Information Technology', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Asset Management', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional A', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional B', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional C', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional D', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional E', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Regional F', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Operational 1', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Operational 2', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Procurement', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59'],
            ['cost_name' => 'Maulana Center', 'region' => 'Head Office', 'company_name' => 'PT. Maulana Sukses Selalu', 'created_at' => '2023-07-02 07:36:59', 'updated_at' => '2023-07-02 07:36:59']
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
