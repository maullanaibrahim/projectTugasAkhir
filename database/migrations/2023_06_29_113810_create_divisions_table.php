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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('division_code')->unique();
            $table->string('division_name');
            $table->string('location');
            $table->string('address');
            $table->timestamps();
        });

        DB::table('divisions')->insert([
            ['division_code' => 'ITS', 'division_name' => 'Information Technology', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'ASM', 'division_name' => 'Asset Management', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGA', 'division_name' => 'Regional A', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGB', 'division_name' => 'Regional B', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGC', 'division_name' => 'Regional C', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGD', 'division_name' => 'Regional D', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGE', 'division_name' => 'Regional E', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'RGF', 'division_name' => 'Regional F', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'OA1', 'division_name' => 'Operational 1', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'OA2', 'division_name' => 'Operational 2', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'PRC', 'division_name' => 'Procurement', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_code' => 'MC', 'division_name' => 'Maull Center', 'location' => 'head office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
