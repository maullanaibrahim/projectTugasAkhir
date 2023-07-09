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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name');
            $table->timestamps();
        });

        DB::table('positions')->insert([
            ['position_name' => 'Admin', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Asisten Kepala Toko', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Barista', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Chief', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Direktur', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Junior Staff', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Kasir', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Kepala Toko', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Koordinator Wilayah', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Manager', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Senior Manager', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Service Crew', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['position_name' => 'Staff', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
