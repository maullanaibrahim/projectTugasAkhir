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
            $table->string('nama_jabatan');
            $table->timestamps();
        });

        DB::table('positions')->insert([
            ['nama_jabatan' => 'Admin', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Asisten Kepala Toko', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Barista', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Chief', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Direktur', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Junior Staff', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Kasir', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Kepala Toko', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Koordinator Wilayah', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Manager', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Senior Manager', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Service Crew', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['nama_jabatan' => 'Staff', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59']
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
